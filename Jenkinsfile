pipeline {
    agent any

    stages {
        stage('PHPUnit Testing') {
            steps {
                echo 'Testing.....'
                php ./vendor/bin/phpunit -v --colors=always ./tests
            }
        }
    }
}
