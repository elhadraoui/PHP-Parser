<?php

namespace PHPParser\Template;

use PHPParser\Parser\Parser;

class Loader
{
    protected $parser;
    protected $baseDir;
    protected $suffix;

    /**
     * Constructs a filesystem template loader.
     *
     * The templates are loaded from {baseDir}/{name}{suffix}.
     *
     * @param PHPParser\Parser $parser  A PHP parser instance
     * @param string           $baseDir The base directory to load templates from
     * @param string           $suffix  An optional suffix to append after the template name
     */
    public function __construct(Parser $parser, $baseDir, $suffix = '') {
        if (!is_dir($baseDir)) {
            throw new \InvalidArgumentException(
                sprintf('The specified base directory "%s" does not exist', $baseDir)
            );
        }

        $this->parser  = $parser;
        $this->baseDir = $baseDir;
        $this->suffix  = $suffix;
    }

    /**
     * Loads the template with the specified name.
     *
     * @param string $name The name of template
     *
     * @return PHPParser\Template The loaded template
     */
    public function load($name) {
        $file = $this->baseDir . '/' . $name . $this->suffix;

        if (!is_file($file)) {
            throw new \InvalidArgumentException(
                sprintf('The file "%s" does not exist', $file)
            );
        }

        return new Template($this->parser, file_get_contents($file));
    }
}