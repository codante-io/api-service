<?php

use Illuminate\Support\Facades\Schedule;


Schedule::command('frases-motivacionais:reset')->hourly();