<?php

namespace Drupal\glossary_tooltip\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Controller for the term page.
 */
class TermController extends ControllerBase {

  /**
   * Renders the term page.
   */
  public function termPage($taxonomy_term) {
    $term = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->load($taxonomy_term);

    if ($term) {
      $build = [
        '#type' => 'container',
        '#attributes' => [
          'class' => ['term-page'],
        ],
        'description' => [
          '#markup' => $term->getDescription(),
          '#allowed_tags' => ['p', 'a'],
        ],
        'read_more' => [
          '#type' => 'link',
          '#title' => $this->t('Read more'),
          '#url' => Url::fromRoute('entity.taxonomy_term.canonical', ['taxonomy_term' => $term->id()]),
        ],
      ];

      return $build;
    }
    else {
      // Redirect to a 404 page if the term doesn't exist.
      return new RedirectResponse(Url::fromRoute('<front>')->toString(), 404);
    }
  }

}
