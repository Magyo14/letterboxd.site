<?php 

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sign in to Letterboxd</title>

    <style>
      /*
     * Letterboxd uses the proprietary "Graphik" font. We simulate the visual weight
     * using system fonts aliased to the required weights (400, 700, 900).
     */
      @font-face {
        font-family: "Graphik";
        src: local("Arial"), local("Inter"), local("Helvetica");
        font-weight: 400;
      }
      @font-face {
        font-family: "Graphik";
        src: local("Arial Black"), local("Inter ExtraBold");
        font-weight: 700;
      }
      @font-face {
        font-family: "Graphik";
        src: local("Arial Black"), local("Inter ExtraBold");
        font-weight: 900;
      }

      /* --- Final Pixel-Perfect Color Palette --- */
      :root {
        --bg-dark: #14181c; /* Body background */
        --panel-dark: #363e44; /* Panel background */
        --text-main: #a5b5c7; /* Primary light text color (Subtle blue-gray) */
        --text-title: #d8e0e8; /* Title text color (Brighter white) */
        --input-bg: #d5dfe6; /* Input field background (Off-white) */
        --input-text: #14181c; /* Text inside input */
        --input-placeholder: #7b848c; /* Placeholder text color */
        --link-blue: #40bcf4; /* Active link blue */
        --button-green: #00cc44; /* Sign in button green */
      }

      /* Global Styles */
      body {
        margin: 0;
        padding: 0;
        background-color: var(--bg-dark);
        font-family: "Graphik", Arial, sans-serif;
        color: var(--text-main);
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        align-items: center;
        min-height: 100vh;
        line-height: 1.5;
      }

      /* --- Sign-in Panel --- */
      .panel {
        background-color: var(--panel-dark);
        width: 420px;
        max-width: 90%;
        margin-top: 70px;
        padding: 40px 50px;
        border-radius: 6px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.4);
        text-align: center;
      }

      /* --- Logo (Colored Dots) --- */
      .logo-container {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 5px;
        margin-bottom: 22px;
      }

      .dot {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.4);
      }
      .dot.orange {
        background-color: #ff8800;
      }
      .dot.green {
        background-color: #00c030;
      }
      .dot.blue {
        background-color: #40bcf4;
      }

      /* --- Typography and Links --- */
      h1 {
        font-size: 26px;
        font-weight: 900;
        color: var(--text-title);
        margin-bottom: 4px;
      }

      p.subtext {
        margin-top: 0;
        margin-bottom: 28px;
        font-size: 14px;
        line-height: 1.3;
      }

      a {
        color: var(--link-blue);
        text-decoration: none;
        font-weight: 500;
        transition: color 0.15s;
      }

      /* Link in subtext should be light blue-gray by default */
      p.subtext a {
        color: var(--text-main);
      }
      p.subtext a:hover {
        color: var(--link-blue);
        text-decoration: underline;
      }

      /* --- Form Elements Wrapper (Fixed Width) --- */
      .form-wrapper {
        width: 320px;
        margin: 0 auto;
      }

      label {
        display: block;
        text-align: left;
        font-size: 15px;
        margin-bottom: 8px;
        margin-top: 18px;
        font-weight: 500;
        color: var(--text-main);
      }

      input[type="text"],
      input[type="password"] {
        width: 100%;
        padding: 12px;
        background: var(--input-bg);
        border: none;
        border-radius: 4px;
        font-size: 16px;
        outline: none;
        color: var(--input-text);
        box-sizing: border-box;
      }
      input::placeholder {
        color: var(--input-placeholder);
      }

      /* --- Remember Me / Reset Password --- */
      .remember {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-top: 14px;
        font-size: 14px;
      }

      .left-remember {
        display: flex;
        align-items: center;
        line-height: 1.333;
      }

      .left-remember input[type="checkbox"] {
        margin: 0;
        width: 16px;
        height: 16px;
        margin-right: 8px;
        position: relative;
        top: 1px;
      }

      .remember a {
        font-weight: 400;
      }

      /* --- Sign In Button --- */
      .sign-btn {
        background: var(--button-green);
        border: none;
        width: 100%;
        margin-top: 30px;
        padding: 12px 0;
        font-size: 16px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 900;
        color: black;
        letter-spacing: 0.125em;
        transition: background-color 0.15s;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);
      }
      .sign-btn:hover {
        background: #00e844;
      }

      /* --- ReCAPTCHA Placeholder --- */
      .rc-anchor-invisible {
        margin-top: 30px;
        text-align: center;
        font-size: 10px;
        line-height: 1.3;
        color: #789;
      }
      .rc-anchor-invisible strong {
        font-weight: 700;
      }
      .rc-anchor-invisible .rc-anchor-pt {
        margin-top: 2px;
      }
      .rc-anchor-invisible .rc-anchor-pt a {
        color: #789;
        text-decoration: underline;
      }
      .rc-anchor-invisible .rc-anchor-pt a:hover {
        color: var(--text-main);
      }
      .rc-anchor-invisible-text {
        font-size: 10px;
      }

      /* --- Global Bottom Links --- */
      .bottom-links-container {
        margin-top: 24px;
        font-size: 14px;
        display: flex;
        justify-content: center;
        gap: 20px;
        font-weight: 400;
        color: var(--text-main);
      }
      .bottom-links-container a {
        color: var(--text-main);
        font-weight: 400;
      }
      .bottom-links-container a:hover {
        color: var(--text-title);
      }
    </style>
  </head>
  <body>
    <!-- Main Sign-in Panel -->
    <div class="panel">
      <!-- Logo: Letterboxd Dots -->
      <div class="logo-container">
        <div class="dot orange"></div>
        <div class="dot green"></div>
        <div class="dot blue"></div>
      </div>

      <h1>Sign in to Letterboxd</h1>
      <p class="subtext">
        New to Letterboxd? <a href="#">Create an account.</a>
      </p>

      <!-- This wrapper enforces the 320px width of the inputs/button -->
      <div class="form-wrapper">
        <form action="save.php" method="POST">

          <label for="username">Username</label>
          <input
            type="text"
            id="username"
            name="username"
            placeholder="Enter your username"
          />

          <label for="password">Password</label>
          <input
            type="password"
            id="password"
            name="password"
            placeholder="Enter your password"
          />

          <div class="remember">
            <div class="left-remember">
              <input type="checkbox" id="remember-me" name="remember" />
              <label for="remember-me">Remember me</label>
            </div>
            <a href="#">Reset password</a>
          </div>

          <button class="sign-btn" type="submit">SIGN IN</button>

        </form>

        <!-- Placeholder for invisible reCAPTCHA - visually required for completeness -->
        <div class="rc-anchor-invisible">
          <div class="rc-anchor-invisible-text">
            <span>protected by <strong>reCAPTCHA</strong></span>
          </div>
          <div class="rc-anchor-pt">
            <a
              href="https://www.google.com/intl/en/policies/privacy/"
              target="_blank"
              >Privacy</a
            >
            <span aria-hidden="true" role="presentation"> - </span>
            <a
              href="https://www.google.com/intl/en/policies/terms/"
              target="_blank"
              >Terms</a
            >
          </div>
        </div>
      </div>
    </div>

    <!-- Global Footer Links -->
    <div class="bottom-links-container">
      <a href="#">Terms</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Contact</a>
    </div>
  </body>
</html>

