<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('api:orders-api:reset')->hourly();
Schedule::command('api:frases-motivacionais:reset')->hourly();
