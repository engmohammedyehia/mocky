pipeline {
    agent none
    environment {
        ACCEPTANCE_TESTING_CONTAINER = ""
    }
    stages {
        stage('Checkout') {
            agent any
            steps {
                cleanWs()
                sh 'rm -rf ./vendor'
                git url: 'https://github.com/engmohammedyehia/mocky.git'
            }
        }
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
                sh 'docker build -t firefoxegy/mock .'
                sh 'docker login --username firefoxegy --password rebo1531982'
                sh 'docker push firefoxegy/mock'
            }
        }
        stage('Acceptance Testing') {
            agent any
            steps {
                sh 'docker run -d -e MOCK_CONFIG_FILE=/home/endpoints.yaml -e MOCK_SERVER_IP=0.0.0.0 -e MOCK_SERVER_PORT=9501 -e MOCK_SERVER_PREFIX="" -e MOCK_SERVER_LOGGING=1,2 -p 80:9501 --name mock_server_container firefoxegy/mock'
                script {
                    ACCEPTANCE_TESTING_CONTAINER=${docker inspect -f '{{range .NetworkSettings.Networks}}{{.IPAddress}}{{end}}' jenkins-blueocean}
                }
                sh 'curl -X POST http://${ACCEPTANCE_TESTING_CONTAINER}:9501/employees'
            }
        }
    }
    post {
        always {
            node('master') { 
                sh 'docker stop mock_server_container'
            }
        }
    }
}
