<?php

namespace App\Exceptions;

use RuntimeException;

/**
 * Thrown when an adoption status change would break the "siapa cepat dia dapat" rules
 * (e.g. paying for a shoe someone else already reserved). The message is safe to show users.
 */
class AdoptionConflictException extends RuntimeException
{
}
