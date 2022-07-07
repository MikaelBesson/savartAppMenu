import "antd/dist/antd.css";
import { useEffect, useState } from "react";
import { Select } from "../Select/Select";
import { Option } from "../Select/Option";

export const ShowModalMenu = function () {
  const [selectedCategory, setSelectedCategory] = useState(0);
  const [categories, setCategories] = useState(new Map());

  useEffect(() => {
    fetch("/api/category/all")
      .then((categories) => categories.json())
      .then((cats) => {
        const stateCategories = new Map();
        cats.map((category) => stateCategories.set(category.id, category));
        setCategories(stateCategories);
      })
      .catch((error) => console.error("error de récupération"));
  }, []);

  return (
    <div className="modal-menu-selection">
      <select
        onChange={(e) =>
          setSelectedCategory(
            parseInt(e.target.options[e.target.options.selectedIndex].value)
          )
        }
      >
        <option value="" disabled selected>
          Choisir une categorie
        </option>
        {Array.from(categories).map((item) => (
          <option key={item[1].id} value={item[1].id}>
            {item[1].name}
          </option>
        ))}
      </select>
      <br />
      <br />

      {selectedCategory !== 0 && (
        <>
          <Select title="Choisir une recette">
            {categories.get(selectedCategory).recipes.map((recipe) => (
              <Option key={recipe.id} value={recipe.id} img={recipe.image}>
                {recipe.name}
              </Option>
            ))}
          </Select>
        </>
      )}
    </div>
  );
};
