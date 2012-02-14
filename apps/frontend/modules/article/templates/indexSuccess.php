<div id="title"><?php echo $article->getTitle(); ?></div>
<div id="description"><?php echo htmlspecialchars_decode($article->getDescription()); ?></div>
<div id="content"><?php echo htmlspecialchars_decode($article->getContent()); ?></div>