import PropTypes from "prop-types";
import classnames from "classnames";

import styles from "./Todos.module.css";
import plusIcon from "../../assets/plus-icon.svg";
import minusIcon from "../../assets/minus-icon.svg";

const Todos = ({ todos, onSubstraction, onAddition }) => {
  return (
    <div className={styles.todos}>
      {todos.map((todo, index, arr) => {
        return (
          <div
            key={index}
            className={classnames(styles.todo, {
              /*
              styles todoDivider aktif ketika kondisi terpenuhi
              !(arr.length === index + 1) selama bukan elemen terakhir maka style.todoDivider akan digabungkan dengan styles.todo 
              jika kondisi !(arr.length === index + 1) tidak terpenuhi maka [styles.todoDivider]: !(arr.length === index + 1) kode tersebut tidak akan terimplementasi
              */
              [styles.todoDivider]: !(arr.length === index + 1),
            })}
          >
            {todo.title}
            <div className={styles.todoIconWrapper}>
              <div className={styles.todoCount}>{todo.count}</div>

              <button
                onClick={() => onSubstraction(index)}
                className={styles.todoActionButton}
              >
                <img src={minusIcon} alt="minus icon" />
              </button>

              <button
                onClick={() => onAddition(index)}
                className={styles.todoActionButton}
              >
                <img src={plusIcon} alt="plus icon" />
              </button>
            </div>
          </div>
        );
      })}
    </div>
  );
};

Todos.propTypes = {
  todos: PropTypes.arrayOf(
    PropTypes.shape({
      title: PropTypes.title,
      count: PropTypes.count,
    })
  ),
  onSubstraction: PropTypes.func,
  onAddition: PropTypes.func,
};

export default Todos;
