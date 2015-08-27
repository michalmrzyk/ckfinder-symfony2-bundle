<?php
/*
 * This file is a part of the CKFinder bundle for Symfony.
 *
 * Copyright (C) 2015, CKSource - Frederico Knabben. All rights reserved.
 *
 * Licensed under the terms of the MIT license.
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

namespace CKSource\Bundle\CKFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Controller for handling requests to CKFinder connector.
 */
class CKFinderController extends Controller
{
    /**
     * Action that handles all CKFinder requests.
     *
     * @param Request $request
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function requestAction(Request $request)
    {
        /* @var \CKSource\CKFinder\CKFinder $ckfinder */
        $ckfinder = $this->get('ckfinder.connector');

        return $ckfinder->handle($request);
    }

    /**
     * Action for CKFinder usage examples.
     *
     * To browse examples, please uncomment ckfinder_examplesroute in
     * Resources/config/routing.yml and navigate to the /ckfinder/examples path.
     *
     * @param string|null $example
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function examplesAction($example = null)
    {
        switch ($example) {
            case 'fullpage':
                return $this->render('CKSourceCKFinderBundle:examples:fullpage.html.twig');
            case 'widget':
                return $this->render('CKSourceCKFinderBundle:examples:widget.html.twig');
            case 'popup':
                return $this->render('CKSourceCKFinderBundle:examples:popup.html.twig');
            case 'modal':
                return $this->render('CKSourceCKFinderBundle:examples:modal.html.twig');
            case 'ckeditor':
                return $this->render('CKSourceCKFinderBundle:examples:ckeditor.html.twig');
            case 'filechooser':
                $form = $this->createFormBuilder()
                    ->add('foo', 'text')
                    ->add('bar', 'date')
                    ->add('ckf1', 'ckfinder_file_chooser', array(
                        'label' => 'File Chooser 1',
                        'button_text' => 'Browse files (popup)',
                        'button_attr' => array(
                            'class' => 'my-class'
                        )
                    ))
                    ->add('ckf2', 'ckfinder_file_chooser', array(
                        'label' => 'File Chooser 2',
                        'mode' => 'modal',
                        'button_text' => 'Browse files (modal)',
                    ))
                    ->getForm();

                return $this->render('CKSourceCKFinderBundle:examples:filechooser.html.twig', array(
                    'form' => $form->createView()
                ));
        }

        return $this->render('CKSourceCKFinderBundle:examples:index.html.twig');
    }

}
