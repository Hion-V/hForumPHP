node {
    //change
    stage ('cleanup'){
        sh '''
            if [ -d "jenkins-testapache" ]; then
                rm -R jenkins-testapache
            fi
            if [ -d "hForumPHP" ]; then
                rm -R hForumPHP
            fi
            if [ -d "selenium-python" ]; then
                rm -R selenium-python
            fi
        '''
    }
    stage('prepare') {
        sh '''
            git clone git@github.com:Hion-V/hForumPHP.git
            git -C ./hForumPHP/ checkout Dev
            git clone git@github.com:Hion-V/jenkins-testapache.git
            cp -r hForumPHP/dev_mvc jenkins-testapache/app
        ''' 
    }
    stage('build'){
        sh 'docker build -t hforumphp-testapache jenkins-testapache'
        sh '''
            git clone git@github.com:Hion-V/selenium-python.git
            docker build -t=hforumselenium ./selenium-python 
        '''
    }
    stage('kill'){
        sh '''
            #!/bin/bash
            # kills and removes all containers and their associated volume of name specified
            # Force remove containers of the same name

            # Make shell exits when an errorcode is returns instead of returning the errorcode to jenkins
            set +e
            #set containername to $1
            containername="hforum"
            if [ ! -z "$containername" ]
            then
                    containers=$(docker ps -q -a -f name=$containername)
                    if [ ! -z "$containers" ]
                    then
                            echo "Shutting down containers $containers"
                            docker rm -f -v $containers
                    else
                            echo "Couldn't find any containers matching that name"
                    fi
            else
                    echo "You must specify a (partial) container name"
            fi
        '''
    }
    stage('run')
    {
        sh '''
            # SQL

            docker run -d \
            --name hforumsql \
            -p 3306:3306 \
            --network=hforumphpbridge \
            --env MYSQL_ROOT_PASSWORD=jenk mysql:5.7.27
            #--env "VIRTUAL_HOST=forumdb.subsonics.nl" \
            #--env "LETSENCRYPT_HOST=forumdb.subsonics.nl" \



            # Apache

            docker run -d \
            --name hforumapache \
            --env "SQL_CREDENTIALS=true" \
            --env "SQL_SERVER=hforumsql" \
            --env "SQL_USERNAME=root" \
            --env "SQL_PASSWORD=jenk" \
            --env "SQL_DATABASE=webforum" \
            --network=hforumphpbridge \
            --env "ADMIN_ACTION_KEY=jenk" hforumphp-testapache
            #--env "VIRTUAL_HOST=forum.subsonics.nl" \
            #--env "VIRTUAL_PORT=80" \
            #--env "LETSENCRYPT_HOST=forum.subsonics.nl" \


            # phpmyadmin

            docker run -d \
            --name hforummyadmin \
            --env "PMA_HOST=hforumsql" \
            --network=hforumphpbridge phpmyadmin/phpmyadmin
            #--env "VIRTUAL_HOST=forumphpmyadmin.subsonics.nl" \
            #--env "VIRTUAL_PORT=80" \
            #--env "LETSENCRYPT_HOST=forumphpmyadmin.subsonics.nl" \



            #network

            #docker network connect hforumphpbridge hforumapache
            #docker network connect hforumphpbridge hforummyadmin
        '''
    }
    stage('test'){
        sh '''
            docker run \
                --network hforumphpbridge \
                -v /var/run/docker.sock:/var/run/docker.sock \
                --rm \
                --name hforumselenium hforumselenium
        '''
    }
    stage('deploy'){
        echo 'this is where we would start deploying the '
        sh '''
            echo test
        '''
    }
}