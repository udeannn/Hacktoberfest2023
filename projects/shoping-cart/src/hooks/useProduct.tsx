import { useContext } from "react";
import ProductsContext, {
  UseProductContextType,
} from "../context/ProductProvider";

const useProduct = (): UseProductContextType => {
  return useContext(ProductsContext);
};

export default useProduct;
