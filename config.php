<?php

return [

		'mail' => [

			/**
			*	Mail Server
			*/
			'host'		    => 'smtp.gmail.com',
			'port'		    =>  465,
			'encryption'	=> 'ssl',

			/**
			* User Credential
			*/
			'username'      => 'example@gmail.com',
			'password'	    => 'secret',

			/*
			 *  Sender email address & name			 *
			 */
			'from' => [

				'email'     => 'admin@example.com',
				'name'	    => 'Administrator'

			],

			/*
			 * reply email address & name			 *
			 */
			'reply' => [

				'email'     => 'contact@example.com',
				'name'      => 'Information'

			],

            /*
             *  Log Email
             */
            'log'       => false
		]

	];