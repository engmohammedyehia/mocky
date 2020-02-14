pipeline {
    agent none
    stages {
        stage('Install Dependencies') {
            agent {
                docker { 
                    image 'composer' 
                }
            }
            steps {
                sh 'composer install'
            }
        }
        stage('Unit tests') {
            agent {
                docker { 
                    image 'php' 
                }
            }
            steps {
                sh 'php ./vendor/bin/phpunit -v ./tests'
            }
        }
        stage('Code Analysis') {
            agent {
                docker { 
                    image 'php' 
                }
            }
            steps {
                sh 'php ./vendor/bin/phpcs'
            }
        }
        stage('Build') {
            agent any
            steps {
                sh 'docker build -t docker-registry:5000/mock .'
                sh 'docker push docker-registry:5000/mock'
            }
        }
        stage('Acceptance Testing') {
            agent any
            steps {
                sh 'docker run --name acceptance_test_container -d -e MOCK_CONFIG_FILE=/home/endpoints.yaml -e MOCK_SERVER_IP=0.0.0.0 -e MOCK_SERVER_PORT=9501 -e MOCK_SERVER_PREFIX="" -e MOCK_SERVER_LOGGING=1,2 -p 9501:9501 --name acceptance_test_container docker-registry:5000/mock'
            }
        }
    }
    post {
        always {
            node('master') { 
                sh 'docker stop acceptance_test_container'
            }
        }
    }
}
