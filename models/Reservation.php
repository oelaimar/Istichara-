<?php

namespace models;

class Reservation {
    public function __construct(
        private ?int $id = null,
        private ?int $lawyer_id = null,
        private ?int $hussier_id = null,
        private int $client_id,
        private string $day,
        private string $horaire,
        private bool $is_online = false,
        private ?string $meeting_link = null,
        private string $status = 'pending'
    ) {}

    // Getters
    public function getId(): ?int { return $this->id; }
    public function getLawyerId(): ?int { return $this->lawyer_id; }
    public function getHussierId(): ?int { return $this->hussier_id; }
    public function getClientId(): int { return $this->client_id; }
    public function getDay(): string { return $this->day; }
    public function getHoraire(): string { return $this->horaire; }
    public function isOnline(): bool { return $this->is_online; }
    public function getMeetingLink(): ?string { return $this->meeting_link; }
    public function getStatus(): string { return $this->status; }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function setMeetingLink(?string $link): void { $this->meeting_link = $link; }
}
