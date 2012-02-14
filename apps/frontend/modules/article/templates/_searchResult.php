<?php
/**
 * @package sfLucenePlugin
 * @subpackage Module
 * @author Carl Vondrick <carl@carlsoft.net>
 * @version SVN: $Id: _actionResult.php 7108 2008-01-20 07:44:42Z Carl.Vondrick $
 */
?>

<?php //echo link_to($result->getTitle(), $result->getInternalUri()) ?><!-- (--><?php //echo $result->getScore() ?><!--%)-->
<?php echo link_to(highlight_keywords($result->getTitle(), $query, sfConfig::get('app_lucene_result_highlighter', '<strong class="highlight">%s</strong>')), $result->getInternalUri()) ?> (<?php echo $result->getScore() ?>%)
<p><?php echo highlight_result_text(htmlspecialchars_decode($result->getDescription()), $query, sfConfig::get('app_lucene_result_size', 200), sfConfig::get('app_lucene_result_highlighter', '<strong class="highlight">%s</strong>')) ?></p>
<!--<p>--><?php //echo htmlspecialchars_decode($result->getDescription()) ?><!--</p>-->
