<?php

if (! function_exists('get_public_ip')) {
    /**
     * Retrieves requests' public IP address
     *
     * @return string|null
     */
    function get_public_ip(): ?string
    {
        // $publicIp = trim(shell_exec('dig @ns1.google.com TXT o-o.myaddr.l.google.com +short'));
        // return is_null($publicIp) || empty($publicIp) ? request()->getClientIp() : $publicIp;

        return request()->getClientIp();
    }
}
