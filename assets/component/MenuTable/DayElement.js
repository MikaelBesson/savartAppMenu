import { ShowModalMenu } from "../Modal/ModalMenuSelect";
import Swal from "sweetalert2";
/* @see https://github.com/sweetalert2/sweetalert2-react-content */
import withReactContent from "sweetalert2-react-content";

export const DayElement = function ({ dayName, type }) {
  const ReactSwal = withReactContent(Swal);

  const showCategories = () => {
    let inputValue;
    ReactSwal.fire({
      title: "<strong>Vos envies pour </strong><br>" + dayName + " " + type,
      html: <ShowModalMenu />,
      showCancelButton: true,
      focusConfirm: false,
      confirmButtonText: '<i class="fa fa-thumbs-up"></i> Ok!',
      cancelButtonText: "Annuler",
    }).then((result) => {
      if (result.isConfirmed) {
        Swal.fire("sauvegarde", "reussie", "success").then((r) => {
          console.log();
        });
      } else if (result.isDismissed) {
        Swal.fire("Annuler", "aucun changement sauvegarder", "error");
      }
    });
  };

  return (
    <td onClick={showCategories} className={"box-select"}>
      Cliquez
    </td>
  );
};
