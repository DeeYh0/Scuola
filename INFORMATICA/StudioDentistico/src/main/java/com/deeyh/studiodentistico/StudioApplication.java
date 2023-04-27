package com.deeyh.studiodentistico;

        import javafx.application.Application;
        import javafx.fxml.FXMLLoader;
        import javafx.scene.Scene;
        import javafx.scene.image.Image;
        import javafx.scene.image.ImageView;
        import javafx.stage.Stage;


        import java.io.IOException;

public class StudioApplication extends Application {
    @Override
    public void start(Stage stage) throws IOException {
        FXMLLoader fxmlLoader = new FXMLLoader(StudioApplication.class.getResource("Studio-view.fxml"));
        Scene scene = new Scene(fxmlLoader.load(), 800, 600);
        stage.setTitle("Studio Dentistico");
        stage.setScene(scene);
        stage.show();
        stage.setResizable(false);

    }

    public static void main(String[] args) {
        launch();
    }
}