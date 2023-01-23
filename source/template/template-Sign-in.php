<section>
  <button type="button" onclick="location.href='../php/Login.php';">Log in</button><button type="button" disabled>Sign in</button>
  <form action="../php/Sign-in.php" method="POST">
  <ul>
    <li><label for="nickname">Nickname</label><input type="text" id="nickname" name="nickname"/></li>
    <li><label for="email">Email</label><input type="email" id ="email" name="email"/></li>
    <li><label for="password">Password</label><input type="password" id="password" name="password"/></li>
    <li><label for="name">Name</label><input type="text" id="name" name="name"/></li>
    <li><label for="surname">Surname</label><input type="text" id="surname" name="surname"/></li>
    <li><label for="date">Date</label><input type="date" id="date" name="date"/></li>
    <li><label for="residence">Residence</label>
      <select id="residence" name="residence">
        <option value="Example">Example</option>
        </select>
      </li>
  </ul>
  <button type="submit">Register</button>
  </form>
</section>