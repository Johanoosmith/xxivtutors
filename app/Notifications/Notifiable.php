<?php

namespace App\Notifications;

interface Notifiable {
    public function send();

    public function prevConfiguration();
}