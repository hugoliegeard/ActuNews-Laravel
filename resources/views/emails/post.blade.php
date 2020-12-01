<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
</head>
<body>
    <h1>Publication d'un nouvel article</h1>
    <h3>Un nouvel article vient d'être publié sur votre site</h3>
    <p>Quelques informations :</p>
    <p><img src="{{ url("storage/posts/$post->featuredImage") }}" alt="{{ $post->title }}"></p>
    <ul>
        <li><strong>Titre : </strong> {{ $post->title }}</li>
        <li><strong>Catégorie : </strong> {{ $post->category->name }}</li>
        <li><strong>Auteur : </strong> {{ $post->user->firstname }} {{ $post->user->lastname }}</li>
        <li><strong>Date de Rédaction : </strong> {{ $post->created_at->format('d/m/Y') }}</li>
    </ul>
</body>
</html>
