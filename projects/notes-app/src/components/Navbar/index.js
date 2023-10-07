import React from "react";
import shoppingicon from "../../assets/shopping-icon.svg";
import styles from "./Navbar.module.css";

function Navbar() {
  return (
    <nav className={styles.nav}>
      {/* <img src={shoppingicon} alt="icon" className={styles.navIcon} /> */}
      <h1 className={styles.navTitle}>Notes List</h1>
    </nav>
  );
}

export default Navbar;
