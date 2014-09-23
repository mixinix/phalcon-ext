<?php

namespace Sb\Phalcon\Helpers\Seo;

class Yandex
{
    private $interaction = null;
    private $interactionUrl = null;

    public function isAvailable()
    {
        return (bool) ($this->interaction || $this->interactionUrl);
    }

    public function render()
    {
        $result = '';
        if ($this->getInteraction()) {
            $result .= '<meta property="ya:interaction" content="'.$this->getInteraction().'" />' . "\n";
        }
        if ($this->getInteractionUrl()) {
            $result .= '<meta property="ya:interaction:url" content="'.$this->getInteractionUrl().'" />' . "\n";
        }
        return $result;
    }

    /**
     * @param null $interaction
     */
    public function setInteraction($interaction)
    {
        $this->interaction = $interaction;
    }

    /**
     * @return null
     */
    public function getInteraction()
    {
        return $this->interaction;
    }

    /**
     * @param null $interactionUrl
     */
    public function setInteractionUrl($interactionUrl)
    {
        $this->interactionUrl = $interactionUrl;
    }

    /**
     * @return null
     */
    public function getInteractionUrl()
    {
        return $this->interactionUrl;
    }


} 