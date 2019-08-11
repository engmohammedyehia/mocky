pipeline {
    agent {
        docker { 
            image 'firefoxegy/php7.2_nginx_xdebug_swoole:latest' 
            args '-e COMPOSER_ALLOW_SUPERUSER=1'
        }
    }

    stages {
        stage('Install dependencies') {
            steps {
                echo 'Dependencies installation'
                sh 'composer install'
            }
        }
        stage('PHPUnit Testing') {
            steps {
                echo 'Testing.....'
                sh 'php ./vendor/bin/phpunit -v --colors=always ./tests'
            }
        }
    }
}
