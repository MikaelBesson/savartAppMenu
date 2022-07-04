import "antd/dist/antd.css";
import { useEffect, useState } from "react";

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
          <select>
            <option value="" disabled selected>
              Choisir une recette
            </option>
            {categories.get(selectedCategory).recipes.map((recipe) => (
              <option
                key={recipe.id}
                value={recipe.id}
                /*style={{
                  backgroundImage: `url(${recipe.image})`,
                }}*/
              >
                {recipe.name}
              </option>
            ))}
          </select>
        </>
      )}
    </div>
  );
};
