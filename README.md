Redis Sentinel Cache Store for Moodle
=====================================

A Moodle cache store plugin for [Redis](http://redis.io).

This plugin requires the [PhpRedis](https://github.com/nicolasff/phpredis) extension.  The PhpRedis extension can be installed via PECL with `pecl install redis`.

Prerequisites
-------------

```bash
# Debian
apt install php-pear php-dev
```

Store configuration
-------------------

**Sentinel Servers**

Comma delimited list of sentinel servers.
It is essential to provide the port number along with IP addresses or hostnames.
(e.g. `10.0.0.1:26379,10.0.0.2:26379,10.0.0.3:26379`, where 26379 is the default TCP listening port by Sentinel)

**Sentinel Group**

Must correspond to the group name of your Sentinel server pool, which is configured individually.
Otherwise the current master node won′t be able to be determined by issuing the following command:

```bash
redis-cli -h <SENTINEL_SERVER> -p 26379 SENTINEL get-master-addr-by-name <SENTINEL_GROUP>
1) "<MASTER_IP>"
2) "6379"

# Where 6379 is the default listening port by Redis
```
