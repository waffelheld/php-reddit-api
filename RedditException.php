<?php

namespace \Waffelheld\RedditException;


class RedditException extends Exception
{
    // Die Exception neu definieren, damit die Mitteilung nicht optional ist
    public function __construct($message, $code = 0, Exception $previous = null) {
        // etwas Code

        // sicherstellen, dass alles korrekt zugewiesen wird
        parent::__construct($message, $code, $previous);
    }

    // maßgeschneiderte Stringdarstellung des Objektes
    public function __toString() {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

    public function RedditNoTokenException() {
        echo "Token required\n";
    }
}