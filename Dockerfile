apiVersion: v1
kind: Service
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: service.name.3
  namespace: default
spec:
  ports: [
    ]
  selector:
    app: demo.77
  type: NodePort


#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.77
  name: deployment.name.92
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.77
  template:
    metadata:
      labels:
        app: demo.77
      namespace: default
    spec:
      containers:
      - env:
        - name: WWWUSER
          value: ${WWWUSER}
        - name: LARAVEL_SAIL
          value: '1'
        - name: XDEBUG_MODE
          value: ${SAIL_XDEBUG_MODE:-off}
        - {
          }
        image: sail-8.2/app
        imagePullPolicy: IfNotPresent
        ports: [
          ]
        volumeMounts:
        - mountPath: /var/www/html
          name: pvo.0
      hostAliases:
      - hostnames:
        - host.docker.internal
        ip: host-gateway
      terminationGracePeriodSeconds: 0
      volumes:
      - name: pvo.0
        persistentVolumeClaim:
          claimName: claimname.0

#This is PersistentVolume Kube Object with Name
#pvo.0.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: .
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolumeClaim Kube Object with Name
#claimname.0.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.0

#Generating kubernetes YAML file for the Service mysql.yml
#This is Service Configuration Kube definition
---
apiVersion: v1
kind: Service
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: service.name.8
  namespace: default
spec:
  ports: [
    ]
  selector:
    app: demo.58
  type: NodePort


#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.58
  name: deployment.name.11
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.58
  template:
    metadata:
      labels:
        app: demo.58
      namespace: default
    spec:
      containers:
      - env:
        - name: MYSQL_ROOT_PASSWORD
          value: ${DB_PASSWORD}
        - name: MYSQL_ROOT_HOST
          value: '%'
        - name: MYSQL_DATABASE
          value: ${DB_DATABASE}
        - name: MYSQL_USER
          value: ${DB_USERNAME}
        - name: MYSQL_PASSWORD
          value: ${DB_PASSWORD}
        - name: MYSQL_ALLOW_EMPTY_PASSWORD
          value: '1'
        image: mysql/mysql-server:8.0
        imagePullPolicy: IfNotPresent
        livenessProbe:
          exec:
            command:
            - CMD
          failureThreshold: 3
          initialDelaySeconds: 10
          periodSeconds: 10
          successThreshold: 1
          timeoutSeconds: 1
        ports: [
          ]
        volumeMounts:
        - mountPath: /var/lib/mysql
          name: pvo.0
        - mountPath: /docker-entrypoint-initdb.d/10-create-testing-database.sh
          name: pvo.1
      terminationGracePeriodSeconds: 0
      volumes:
      - name: pvo.0
        persistentVolumeClaim:
          claimName: claimname.0
      - name: pvo.1
        persistentVolumeClaim:
          claimName: claimname.1

#This is PersistentVolume Kube Object with Name
#pvo.0.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: sail-mysql
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolume Kube Object with Name
#pvo.1.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.1
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: ./vendor/laravel/sail/database/mysql/create-testing-database.sh
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolumeClaim Kube Object with Name
#claimname.0.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.0

#This is PersistentVolumeClaim Kube Object with Name
#claimname.1.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.1
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.1

#Generating kubernetes YAML file for the Service redis.yml
#This is Service Configuration Kube definition
---
apiVersion: v1
kind: Service
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: service.name.6
  namespace: default
spec:
  ports: [
    ]
  selector:
    app: demo.45
  type: NodePort


#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.45
  name: deployment.name.81
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.45
  template:
    metadata:
      labels:
        app: demo.45
      namespace: default
    spec:
      containers:
      - image: redis:alpine
        imagePullPolicy: IfNotPresent
        livenessProbe:
          exec:
            command:
            - CMD
          failureThreshold: 3
          initialDelaySeconds: 10
          periodSeconds: 10
          successThreshold: 1
          timeoutSeconds: 1
        ports: [
          ]
        volumeMounts:
        - mountPath: /data
          name: pvo.0
      terminationGracePeriodSeconds: 0
      volumes:
      - name: pvo.0
        persistentVolumeClaim:
          claimName: claimname.0

#This is PersistentVolume Kube Object with Name
#pvo.0.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: sail-redis
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolumeClaim Kube Object with Name
#claimname.0.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.0

#Generating kubernetes YAML file for the Service meilisearch.yml
#This is Service Configuration Kube definition
---
apiVersion: v1
kind: Service
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: service.name.4
  namespace: default
spec:
  ports: [
    ]
  selector:
    app: demo.6
  type: NodePort


#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.6
  name: deployment.name.15
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.6
  template:
    metadata:
      labels:
        app: demo.6
      namespace: default
    spec:
      containers:
      - image: getmeili/meilisearch:latest
        imagePullPolicy: IfNotPresent
        livenessProbe:
          exec:
            command:
            - CMD
          failureThreshold: 3
          initialDelaySeconds: 10
          periodSeconds: 10
          successThreshold: 1
          timeoutSeconds: 1
        ports: [
          ]
        volumeMounts:
        - mountPath: /meili_data
          name: pvo.0
      terminationGracePeriodSeconds: 0
      volumes:
      - name: pvo.0
        persistentVolumeClaim:
          claimName: claimname.0

#This is PersistentVolume Kube Object with Name
#pvo.0.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: sail-meilisearch
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolumeClaim Kube Object with Name
#claimname.0.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.0

#Generating kubernetes YAML file for the Service mailpit.yml
#This is Service Configuration Kube definition
---
apiVersion: v1
kind: Service
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: service.name.8
  namespace: default
spec:
  ports: [
    ]
  selector:
    app: demo.78
  type: NodePort


#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.78
  name: deployment.name.93
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.78
  template:
    metadata:
      labels:
        app: demo.78
      namespace: default
    spec:
      containers:
      - image: axllent/mailpit:latest
        imagePullPolicy: IfNotPresent
        ports: [
          ]
      terminationGracePeriodSeconds: 0

#Generating kubernetes YAML file for the Service selenium.yml

#This is Deployment Configuration Kube definition
---
apiVersion: apps/v1beta1
kind: Deployment
metadata:
  labels:
    app: demo.70
  name: deployment.name.51
  namespace: default
spec:
  replicas: 1
  revisionHistoryLimit: 1
  selector:
    matchLabels:
      app: demo.70
  template:
    metadata:
      labels:
        app: demo.70
      namespace: default
    spec:
      containers:
      - image: selenium/standalone-chrome
        imagePullPolicy: IfNotPresent
        volumeMounts:
        - mountPath: /dev/shm
          name: pvo.0
      hostAliases:
      - hostnames:
        - host.docker.internal
        ip: host-gateway
      terminationGracePeriodSeconds: 0
      volumes:
      - name: pvo.0
        persistentVolumeClaim:
          claimName: claimname.0

#This is PersistentVolume Kube Object with Name
#pvo.0.yml
---
apiVersion: v1
kind: PersistentVolume
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: pvo.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  capacity:
    storage: 10Gi
  hostPath:
    path: /dev/shm
    type: Directory
  persistentVolumeReclaimPolicy: Retain

#This is PersistentVolumeClaim Kube Object with Name
#claimname.0.yml
---
apiVersion: v1
kind: PersistentVolumeClaim
metadata:
  annotations:
    generated.by: 8gwifi.org
  name: claimname.0
  namespace: default
spec:
  accessModes:
  - ReadWriteOnce
  resources:
    requests:
      storage: 1Gi
  volumeName: pvo.0
