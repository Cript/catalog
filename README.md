## Build production docker images
```
docker build -t aboro/kt_base -f ./devops/docker/Dockerfile .
docker build -t aboro/kt_catalog -f ./devops/docker/php/Dockerfile .
docker build -t aboro/kt_nginx -f ./devops/docker/nginx/Dockerfile .
```

## Launch production images
```docker compose -f docker-compose.yml -f docker-compose.prod.yml up -d```

## Development environment
```
docker compose up -d
yarn encore dev-server
```

Local url: http://localhost:1000/
