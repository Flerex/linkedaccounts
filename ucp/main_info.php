<?php

namespace flerex\linkedaccounts\ucp;

class main_info
{
    public function main()
    {
        return array(
            'filename'  => '\flerex\linkedaccounts\ucp\main_module',
            'title'     => 'LINKED_ACCOUNTS',
            'modes'    => array(
                'management'  => array(
                    'title' => 'UCP_MANAGEMENT_TITLE',
                    'auth'  => 'flerex/linkedaccounts && acl_a_board',
                    'cat'   => array('LINKED_ACCOUNTS'),
                ),
            ),
        );
    }
}