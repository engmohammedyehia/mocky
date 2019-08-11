pipeline {
    docker { image 'firefoxegy/php7.2_nginx_xdebug_swoole' }

    stages {
        stage('PHPUnit Testing') {
            steps {
                echo 'Testing.....'
                sh 'php ./vendor/bin/phpunit -v --colors=always ./tests'
            }
        }
    }
}
