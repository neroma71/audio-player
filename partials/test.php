echo "<li>
                <a href='posts.php?id_cat=".$categorie['id_categorie']."'>
                        <h3 class='titre'>".htmlspecialchars($categorie['intitule'])."</h3>
                    <div class='intro'>
                        <p>
                            ".htmlspecialchars($categorie['intro'])."
                        </p>
                    </div>
                </a>
                    <div class='image' style='background:white url(upload/".$categorie['avatar'].")no-repeat; background-size:cover;'>
                    </div>
                </li>";