<?php

//-----------------------------------------------------------------------------

/**
 * MarkupNewLines Middleware Class - Goals:
 * # convert database extracted strings as such: '\n' -> '<br>'
 * # coop with ServerDatabaseConversion::class
 */

namespace App\Http\Middleware\Response;

use App\Helper\ServerDatabaseConversion;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MarkupNewLines
{
  /**
  * Handle an incoming request.
  *
  * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
  */
  public function handle(Request $request, Closure $next): Response
  {
    // [TODO]
    // assert you dont BRICK whole HTML output
    // assert you only convert database fetch
    // ( Think: slugs, custom keywords to distinguish newlines )
    return $next($request);

    // Proceed with the Request and get Response
    $response = $next($request);

    // Modify Response only if text/html
    if ($response instanceof Response)
    {
      if (preg_match('#text/html#', $response->headers->get('content-type')))
      {
        // Convert '\n' -> '<br>'
        $content = $response->getContent();
        $content = ServerDatabaseConversion::markupNewlines($content);
        $response->setContent($content);
      }
    }

    return $response;
  }
}
