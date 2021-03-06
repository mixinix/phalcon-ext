<?php

namespace Sb\Phalcon\Service\Seo\Module;

class OpenGraph extends AbstractModule
{
    private $locale = null;
    private $type = null;
    private $title = null;
    private $url = null;
    private $description = null;
    private $site_name = null;
    private $image = null;

    private $ogData = [];

    private $ogNamespaces = [
        'og' => 'og: http://ogp.me/ns#',
        'books' => 'books: http://ogp.me/ns/books#'
    ];

    const OG_TYPE_BOOKS = 'books.book';
    const OG_TYPE_ARTICLE = 'article';
    const OG_TYPE_WEBSITE = 'website';

    const OG_TYPE = 'og:type';
    const OG_TITLE = 'og:title';
    const OG_URL = 'og:url';
    const OG_IMAGE = 'og:image';

    const OG_LOCALE = 'og:locale';
    const OG_DESCRIPTION = 'og:description';
    const OG_SITE_NAME = 'og:site_name';

    /**
     * @deprecated use getOgPrefix
     * @return bool
     */
    public function isAvailable()
    {
        return (bool)
            $this->locale ||
            $this->type ||
            $this->title ||
            $this->url ||
            $this->description ||
            $this->site_name ||
            $this->image;
    }

    public function getOgPrefix()
    {
        $namespaces = [];
        foreach ($this->ogData as $ogData) {
            foreach ($ogData as $ogType => $ogValue) {
                $temp = explode(":", $ogType, 2);
                $namespaces[] = $temp[0];
            }
        }
        $namespaces = array_unique($namespaces);

        $result = [];
        foreach ($namespaces as $namespace) {
            if (array_key_exists($namespace, $this->ogNamespaces)) {
                $result[] = $this->ogNamespaces[$namespace];
            }
        }

        return trim(implode(" ", $result));
    }

    public function add($attribute, $value)
    {
        $this->ogData[] = [
            $attribute => $value
        ];
    }

    public function render()
    {
        if ($this->ogData) {
            $result = '';
            foreach ($this->ogData as $ogData) {
                foreach ($ogData as $ogType => $ogValue) {
                    $result .= '    <meta property="' . $ogType . '" content="' . str_replace('"', '', $ogValue) . '" />' . "\n";
                }
            }
            return $result;
        }

        $result = '';
        if ($this->getLocale()) {
            $result .= '    <meta property="og:locale" content="'.str_replace('"', '', $this->getLocale()).'" />' . "\n";
        }
        if ($this->getType()) {
            $result .= '    <meta property="og:type" content="'.str_replace('"', '', $this->getType()).'" />' . "\n";
        }
        if ($this->getTitle()) {
            $result .= '    <meta property="og:title" content="'.str_replace('"', '', $this->getTitle()).'" />' . "\n";
        }
        if ($this->getUrl()) {
            $result .= '    <meta property="og:url" content="'.str_replace('"', '', $this->getUrl()).'" />' . "\n";
        }
        if ($this->getDescription()) {
            $result .= '    <meta property="og:description" content="'.str_replace('"', '', $this->getDescription()).'" />' . "\n";
        }
        if ($this->getSiteName()) {
            $result .= '    <meta property="og:site_name" content="'.str_replace('"', '', $this->getSiteName()).'" />' . "\n";
        }
        if ($this->getImage()) {
            $result .= '    <meta property="og:image" content="'.str_replace('"', '', $this->getImage()).'" />' . "\n";
        }
        return $result;
    }

    /**
     * @param null $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $image
     * @return $this
     */
    public function setImage($image)
    {
        $this->image = $image;
        return $this;
    }

    /**
     * @return null
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param null $locale
     * @return $this
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
        return $this;
    }

    /**
     * @return null
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @param null $site_name
     * @return $this
     */
    public function setSiteName($site_name)
    {
        $this->site_name = $site_name;
        return $this;
    }

    /**
     * @return null
     */
    public function getSiteName()
    {
        return $this->site_name;
    }

    /**
     * @param null $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return null
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null $url
     * @return $this
     */
    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }


}