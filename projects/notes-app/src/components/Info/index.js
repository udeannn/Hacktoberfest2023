import PropTypes from "prop-types";

import styles from "./Info.module.css";

const Info = ({ todosLength, totalCounts, onDelete }) => {
  return (
    <div className={styles.info}>
      <div className={styles.infoTotal}>
        <p>{`Total List: ${todosLength}`}</p>
      </div>

      <div className={styles.infoTotal}>
        <p>{`Total Counts: ${totalCounts}`}</p>
      </div>

      <button onClick={onDelete} className={styles.deleteAllButton}>
        Delete All List
      </button>
    </div>
  );
};

Info.propTypes = {
  todosLength: PropTypes.number,
  totalCounts: PropTypes.func,
  onDelete: PropTypes.func,
};

export default Info;
