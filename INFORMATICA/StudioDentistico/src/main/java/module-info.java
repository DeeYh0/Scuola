module com.deeyh.studiodentistico {
    requires javafx.controls;
    requires javafx.fxml;


    opens com.deeyh.studiodentistico to javafx.fxml;
    exports com.deeyh.studiodentistico;
}