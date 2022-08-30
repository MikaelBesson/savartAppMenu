import { BrowserRouter, Route, Routes } from "react-router-dom";
import "../scss/app.scss";
import { Home } from "../component/Home";
import { RouteNotFound } from "../component/RouteNotFound";
import * as ReactDOM from "react-dom";
import { AppMenu } from "../component/AppMenu";

ReactDOM.render(
  <BrowserRouter>
    <img src="../images/fondecran2.jpg" alt="/" id="fondecran" />
    <Routes>
      <Route path="" />
      <Route path="/" element={<Home />} />
      <Route path="*" element={<RouteNotFound />} />
      <Route path={"/appmenu"} element={<AppMenu />} />
    </Routes>
  </BrowserRouter>,

  document.getElementById("root")
);
