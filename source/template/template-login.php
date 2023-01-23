<section>
  <button type="button" disabled>Log in</button><button type="button" onclick="location.href='../php/index.php';">Sign in</button>
  <form action="../php/api-login.php" method="POST">
  <ul>
    <li><label for="email">Email</label><input type="email" id ="email" name="email"/></li>
    <li><label for="password">Password</label><input type="password" id="password" name="password"/></li>
  </ul>
  <button type="submit">Next</button>
  </form>
</section>