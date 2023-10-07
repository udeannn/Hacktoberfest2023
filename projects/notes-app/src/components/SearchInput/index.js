import PropTypes from "prop-types";
import styles from "./SearchInput.module.css";

const SearchInput = ({ onSubmit, onChange, value }) => {
  return (
    <form className={styles.form} onSubmit={onSubmit}>
      <input
        onChange={onChange}
        value={value}
        className={styles.input}
        type="text"
        placeholder="Input your list"
      />
      <button className={styles.addButton} type="submit">
        add
      </button>
    </form>
  );
};

SearchInput.propTypes = {
  onSubmit: PropTypes.func,
  onChange: PropTypes.func,
  value: PropTypes.string,
};

export default SearchInput;
