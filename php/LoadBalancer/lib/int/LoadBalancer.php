<?php

namespace Interfaces;

interface LoadBalancer{

    public function addServer(Server $server);
    public function removeServer(string $serverName);
    public function getList();
}