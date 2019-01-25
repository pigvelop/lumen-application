<?php

namespace Pigvelop\LumenApplication;

use Laravel\Lumen\Application as LumenApplication;
use Monolog\Logger;

class Application extends LumenApplication
{
    /**
     * The custom environment path defined by the developer.
     *
     * @var string
     */
    protected $environmentPath;

    /**
     * The environment file to load during bootstrapping.
     *
     * @var string
     */
    protected $environmentFile = '.env';
    
    /**
     * Get the path to the environment file directory.
     *
     * @return string
     */
    public function environmentPath()
    {
        return $this->environmentPath ?: $this->basePath;
    }

    /**
     * Get the environment file the application is using.
     *
     * @return string
     */
    public function environmentFile()
    {
        return $this->environmentFile ?: '.env';
    }
    
    /**
     * Get the fully qualified path to the environment file.
     *
     * @return string
     */
    public function environmentFilePath()
    {
        return $this->environmentPath().DIRECTORY_SEPARATOR.$this->environmentFile();
    }
    
    /**
     * Register container bindings for the application.
     *
     * @return void
     */
    protected function registerLogBindings()
    {
        $this->singleton('Psr\Log\LoggerInterface', function () {
            if ($this->monologConfigurator) {
                return call_user_func($this->monologConfigurator, new Logger($this->logChannel()));
            } else {
                return new Logger($this->logChannel(), [$this->getMonologHandler()]);
            }
        });
    }

    /**
     * Get the name of the log "channel".
     *
     * @return string
     */
    protected function logChannel()
    {
        if ($this->bound('config') &&
            $channel = $this->make('config')->get('app.log_channel')) {
            return $channel;
        }

        return $this->bound('env') ? $this->environment() : 'production';
    }

    /**
     * Get the version number of the application.
     *
     * @return string
     */
    public function version()
    {
        if ($this->bound('config') && $name = $this->make('config')->get('app.name')) {
            return $name . ' (' . $this->make('config')->get('app.version', 'local') . ') - Made with Lumen';
        }

        return 'Lumen (5.5.2) (Laravel Components 5.5.*)';
    }
}
