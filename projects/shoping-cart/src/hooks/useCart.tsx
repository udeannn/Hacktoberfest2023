import { useContext } from "react";
import CartContext, { UseCartContextType } from "../context/CartProvider";

const useCart = (): UseCartContextType => {
  return useContext(CartContext);
};

export default useCart;
