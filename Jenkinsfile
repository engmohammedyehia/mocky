pipeline {
    agent any

    stages {
        stage('PHPUnit Testing') {
            steps {
                echo 'Testing.....'
                sh 'php ./vendor/bin/phpunit -v --colors=always ./tests'
            }
        }
    }
}
