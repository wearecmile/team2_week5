<?php

class Subject
{
    private $observers = [];
    private $state;

    public function getState()
    {
        return $this->state;
    }

    public function setState($state)
    {
        $this->state = $state;
        $this->notifyAllObservers();
    }

    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    public function notifyAllObservers()
    {
        foreach ($this->observers as $observer) {
            $observer->update();
        }
    }
}

abstract class Observer
{
    protected $subject;
    public abstract function update();
}

class BinaryObserver extends Observer
{
    public function __construct($subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update()
    {
        echo '<td class="text-center">' . decbin($this->subject->getState()) . '</td>';
    }
}

class OctalObserver extends Observer
{
    public function __construct($subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update()
    {
        echo '<td class="text-center">' . decoct($this->subject->getState()) . '</td>';
    }
}

class HexaObserver extends Observer
{
    public function __construct($subject)
    {
        $this->subject = $subject;
        $this->subject->attach($this);
    }

    public function update()
    {
        echo '<td class="text-center">' . strtoupper(dechex($this->subject->getState())) . '</td>';
    }
}

if (isset($_POST['input'])) {
    $input = $_POST['input'];

    $subject = new Subject();
    $response = new HexaObserver($subject);
    $response = new OctalObserver($subject);
    $response = new BinaryObserver($subject);

    $response = $subject->setState($input);
    echo $response;
}
