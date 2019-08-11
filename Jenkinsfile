pipeline {
    agent {
        docker { 
            image 'firefoxegy/php7.2_nginx_xdebug_swoole:latest' 
            args '-v $HOME/workspace/mockserver_master:/home/workspace/mockserver_master'
        }
    }

    stages {
        stage('PHPUnit Testing') {
            steps {
                echo 'Testing.....'
                sh 'php ./vendor/bin/phpunit -v --colors=always ./tests'
            }
        }
    }
}
