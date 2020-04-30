<?php

namespace Optimus\Helpers;

class File
{
    /** @var string $path */
    protected $path;

    /** @var string $filename */
    protected $filename;

    /**
     * @param string $path
     * @param string $filename
     */
    public function __construct(string $path, string $filename = null)
    {
        $this->path = $path;
        $this->filename = $filename;

        $this->bootstrap();
    }

    /**
     * Bootstrap initial settings.
     *
     * @return void
     */
    protected function bootstrap()
    {
        if (is_null($this->filename)) {
            $this->filename = basename($this->path);
        }
    }

    /**
     * Get the path.
     *
     * @return string
     */
    public function path()
    {
        return $this->path;
    }

    /**
     * Get the filename.
     *
     * @return string
     */
    public function filename()
    {
        return $this->filename;
    }

    /**
     * Get the contents of the file.
     *
     * @return string
     */
    public function content()
    {
        return file_get_contents($this->path, 'r');
    }
}
