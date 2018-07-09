</div>
<div id="footer">
        <footer class="page-footer black">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">SIA Gente Passar</h5>
                <p class="grey-text text-lighten-4">Sete é igual a 10.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                  <?php  
                    if ($_SESSION['login'] == "admin" and $_SESSION["senha"] = "admin"){
                      echo "<li><a class='grey-text text-lighten-3' href='/admin.php'>Página Inicial</a></li>";
                    }else{
                      echo "<li><a class='grey-text text-lighten-3' href='/home.php'>Página Inicial</a></li>";
                    }
                  ?>            
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © Copyright
            </div>
          </div>
        </footer>       
    </div>
</body>
</html>