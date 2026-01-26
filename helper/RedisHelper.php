<?php
namespace helper;

use Redis;

class RedisHelper {
    private static ?Redis $redis = null;
    private static string $host = 'redis';
    private static int $port = 6379;

    public static function getConnection(): Redis {
        if (self::$redis === null) {
            self::$redis = new Redis();
            try {
                // Silence connection errors to avoid crashing app if Redis is down
                if (!@self::$redis->connect(self::$host, self::$port)) {
                    // Fallback or just return unconnected instance (methods will fail gracefully or throw)
                    // For now, let's throw if we can't connect, or handle in Repo
                }
            } catch (\Exception $e) {
                throw new \Exception("Redis connection failed: " . $e->getMessage());
            }
        }
        return self::$redis;
    }

    public static function set(string $key, $value, int $ttl = 3600): bool {
        $redis = self::getConnection();
        if ($redis->isConnected()) {
            return $redis->setex($key, $ttl, serialize($value));
        }
        return false;
    }

    public static function get(string $key) {
        $redis = self::getConnection();
        if ($redis->isConnected()) {
            $data = $redis->get($key);
            return $data ? unserialize($data) : false;
        }
        return false;
    }
}
