import "@fortawesome/fontawesome-free/css/all.min.css";
import "bootstrap/dist/css/bootstrap.min.css";
import React from "react";
import "./Footer.css"; // Make sure to create and import your custom CSS file

const Footer = () => {
    return (
        <footer className="footer mt-auto py-3 bg-light">
            <div className="container custom-footer">
                <span className="text-muted">
                    Thiết kế bởi: Nguyễn Ngọc Tuyết Nhi . All rights reserved.{" "}
                    <b>Version</b> 3.0.0
                </span>
            </div>
        </footer>
    );
};

export default Footer;
