<?php

namespace Album\Form;

use Laminas\Form\Form;

class AlbumForm extends Form
{
    public function __construct($name = null)
    {
        // We will ignore the name provided to the constructor
        parent::__construct('album');

        $this->add([
            'name' => 'id',
            'type' => 'hidden',
        ]);
        $this->add([
            'name' => 'command',
            'type' => 'text',
            'options' => [
                'label' => 'Command',
            ],
        ]);
        $this->add([
            'name' => 'explanation',
            'type' => 'text',
            'options' => [
                'label' => 'Explanation',
            ],
        ]);
        $this->add([
            'name' => 'type',
            'type' => 'text',
            'options' => [
                'label' => 'Type',
            ],
        ]);
        $this->add([
            'name' => 'submit',
            'type' => 'submit',
            'attributes' => [
                'value' => 'Go',
                'id'    => 'submitbutton',
            ],
        ]);
    }
}

?>