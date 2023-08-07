package application;

import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.Properties;
import javax.swing.JOptionPane;
import javafx.application.Application;
import javafx.collections.FXCollections;
import javafx.collections.ObservableList;
import javafx.event.ActionEvent;
import javafx.geometry.Insets;
import javafx.geometry.Pos;
import javafx.stage.Stage;
import javafx.scene.Scene;
import javafx.scene.control.Button;
import javafx.scene.control.ComboBox;
import javafx.scene.control.Label;
import javafx.scene.control.Menu;
import javafx.scene.control.MenuBar;
import javafx.scene.control.MenuItem;
import javafx.scene.control.PasswordField;
import javafx.scene.control.SeparatorMenuItem;
import javafx.scene.control.TableColumn;
import javafx.scene.control.TableView;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.control.cell.PropertyValueFactory;
import javafx.scene.effect.DropShadow;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.scene.layout.Background;
import javafx.scene.layout.BackgroundFill;
import javafx.scene.layout.BorderPane;
import javafx.scene.layout.CornerRadii;
import javafx.scene.layout.HBox;
import javafx.scene.layout.StackPane;
import javafx.scene.layout.VBox;
import javafx.scene.paint.Color;
import javafx.scene.text.Font;
import javafx.scene.text.FontWeight;

public class Main extends Application {
	
	private static ArrayList<Donor> data;
	private static ObservableList<Donor> dataList;
	private static ArrayList<Stock> data2;
	private static ObservableList<Stock> dataList2;
	private static ArrayList<Employee> data3;
	private static ObservableList<Employee> dataList3;

	private static String dbURL;
	private static String dbUsername = "root";
	private static String dbPassword = "Ritajnoor119";
	private static String URL = "localhost";
	private static String port = "3306";
	private static String dbName = "finalProject";
	private static Connection con;

	private static void connectDB() throws ClassNotFoundException, SQLException {
		dbURL = "jdbc:mysql://" + URL + ":" + port + "/" + dbName + "?verifyServerCertificate=false";
		Properties p = new Properties();
		p.setProperty("user", dbUsername);
		p.setProperty("password", dbPassword);
		p.setProperty("useSSL", "false");
		p.setProperty("autoReconnect", "true");
		Class.forName("com.mysql.jdbc.Driver");
		con = DriverManager.getConnection(dbURL, p);
	}

	@Override
	public void start(Stage primaryStage) {
		try {

			// welcome
			DropShadow shadow = new DropShadow(10, Color.WHEAT);
			StackPane stack = new StackPane();
			BorderPane pane = new BorderPane();
			ImageView view = new ImageView(new Image(new FileInputStream("start.jpeg")));
			view.setFitHeight(60);
			view.setFitWidth(200);
			Button start = new Button(null, view);
			start.setEffect(shadow);
			start.setPrefSize(50, 50);
			BorderPane.setAlignment(start, Pos.BOTTOM_CENTER);
			pane.setBottom(start);
			ImageView welcome = new ImageView(new Image(new FileInputStream("welcom1.jpeg")));
			welcome.setFitHeight(580);
			welcome.setFitWidth(600);
			stack.getChildren().addAll(welcome, pane);
			StackPane.setAlignment(welcome, Pos.CENTER);
			StackPane.setAlignment(pane, Pos.BOTTOM_CENTER);
			Scene scene = new Scene(stack, 700, 650);
/**************************************************************************************************************/
			start.setOnAction((ActionEvent e) -> {
				try {
					ImageView view3 = new ImageView(new Image(new FileInputStream("3.jpeg")));
					view3.setFitHeight(600);
					view3.setFitWidth(650);
					StackPane stack2 = new StackPane();
					BorderPane pane2 = new BorderPane();

					Button Employee = new Button("Employee");
					Employee.setEffect(shadow);
					Employee.setBackground(
							new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
					Employee.setFont(Font.font("", FontWeight.BOLD, 18));

					Button Donor = new Button("Donor");
					Donor.setEffect(shadow);
					Donor.setBackground(
							new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
					Donor.setFont(Font.font("", FontWeight.BOLD, 18));

					HBox h = new HBox();
					h.setEffect(shadow);
					h.setSpacing(15);
					h.setAlignment(Pos.CENTER);
					h.getChildren().addAll(Employee, Donor);
					

					Label who = new Label("----- Who are you from the categories? -----");
					who.setBackground(
							new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
					who.setFont(Font.font("", FontWeight.BOLD, 20));

					VBox v = new VBox();
					v.setSpacing(10);
					v.setAlignment(Pos.CENTER);
					v.getChildren().addAll(who, h);
					pane2.setCenter(v);

					stack2.getChildren().addAll(view3, pane2);
					Scene scene2 = new Scene(stack2, 700, 650);
					primaryStage.setScene(scene2);
					primaryStage.show();

					/******************* Done *************************/
					Employee.setOnAction((ActionEvent e1) -> {
						try {
							primaryStage.close();
							kindOfEmp(primaryStage);
						} catch (FileNotFoundException e4) {
							e4.printStackTrace();
						}
					});

					Donor.setOnAction((ActionEvent e3) -> {
						primaryStage.close();
						try {
							DonorLogin(primaryStage);
						} catch (Exception e2) {
							e2.printStackTrace();
						}
					});

				} catch (FileNotFoundException e4) {
					e4.printStackTrace();
				}

			});

			scene.getStylesheets().add(getClass().getResource("application.css").toExternalForm());
			primaryStage.setScene(scene);
			primaryStage.show();
		} catch (Exception e) {
			e.printStackTrace();
		}
	}

	public static void main(String[] args) {
		launch(args);
	}

	/****************************** done **********************************/
	public static void kindOfEmp(Stage primaryStage) throws FileNotFoundException {
		ImageView view3 = new ImageView(new Image(new FileInputStream("3.jpeg")));
		view3.setFitHeight(700);
		view3.setFitWidth(700);

		DropShadow shadow = new DropShadow(10, Color.WHITE);
		StackPane stack = new StackPane();

		BorderPane pane = new BorderPane();

		Button Admin = new Button("Admin");
		Admin.setEffect(shadow);
		Admin.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
		Admin.setFont(Font.font("", FontWeight.BOLD, 18));

		Button Emp = new Button("Employee");
		Emp.setEffect(shadow);
		Emp.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
		Emp.setFont(Font.font("", FontWeight.BOLD, 18));
/********************************************************************************/
		Button prev = new Button("Back");
		prev.setEffect(shadow);
		prev.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
		prev.setFont(Font.font("", FontWeight.BOLD, 18));

		/******************************************************/
		HBox h1 = new HBox();		
		h1.setSpacing(10);
		h1.setAlignment(Pos.CENTER);
		h1.getChildren().addAll(Admin, Emp);
		DropShadow shadow2 = new DropShadow(10, Color.BLACK);
		
		VBox h2 = new VBox();		
		h2.setSpacing(10);
		h2.setAlignment(Pos.CENTER);
		h2.getChildren().addAll(prev,new Label());	
		h2.setEffect(shadow2);

		Label who = new Label("----- Who are you from the categories? -----");
		who.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGRAY, new CornerRadii(5), Insets.EMPTY)));
		who.setFont(Font.font("", FontWeight.BOLD, 20));

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(who, h1);
		pane.setCenter(v);
		pane.setBottom(h2);
		stack.getChildren().addAll(view3, pane);

		Stage stage2 = new Stage();
		Scene scene = new Scene(stack, 700, 650);
		stage2.setScene(scene);
		stage2.show();

		prev.setOnAction((ActionEvent e) -> {
			stage2.close();
			primaryStage.show();

		});

		Admin.setOnAction((ActionEvent e) -> {
			stage2.close();
			try {
				String kind = "Admin";
				String table = "employee";
				Login(stage2, kind, table);
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}
			;
		});

		Emp.setOnAction((ActionEvent e) -> {
			stage2.close();
			try {
				String kind = "Employee";
				String table = "employee";
				Login(stage2, kind, table);
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}

		});
	}

	/****************************** done **********************************/
	public static void Login(Stage primaryStage, String kind, String table) throws FileNotFoundException {
		// Employee Login

		DropShadow shadow = new DropShadow(10, Color.RED);
		StackPane stack = new StackPane();

		BorderPane pane = new BorderPane();
		Label Username = new Label("Username");
		Label Password = new Label("Password");
		Password.setFont(Font.font("", FontWeight.BOLD, 18));
		Username.setFont(Font.font("", FontWeight.BOLD, 18));
		Password.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));
		Username.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));

		TextField tUser = new TextField();
		PasswordField tPass = new PasswordField();
		tUser.setFont(Font.font("", FontWeight.BOLD, 12));
		tPass.setFont(Font.font("", FontWeight.BOLD, 12));

		HBox h1 = new HBox();
		h1.setSpacing(10);
		h1.setAlignment(Pos.CENTER);
		h1.getChildren().addAll(Username, tUser);

		HBox h2 = new HBox();
		h2.setSpacing(10);
		h2.setAlignment(Pos.CENTER);
		h2.getChildren().addAll(Password, tPass);

		ImageView viewLogin = new ImageView(new Image(new FileInputStream("login.png")));
		ImageView viewPrev = new ImageView(new Image(new FileInputStream("Logout.png")));

		Button login = new Button("Login", viewLogin);
		Button prev = new Button("previous", viewPrev);
		prev.setFont(Font.font("", FontWeight.BOLD, 15));
		login.setFont(Font.font("", FontWeight.BOLD, 15));
		login.setEffect(shadow);
		prev.setEffect(shadow);

		HBox h3 = new HBox();
		h3.setSpacing(15);
		h3.setAlignment(Pos.CENTER);
		h3.getChildren().addAll(prev, login);
		h3.setPadding(new Insets(10));

		VBox v1 = new VBox();
		v1.setSpacing(10);
		v1.setAlignment(Pos.CENTER);
		v1.getChildren().addAll(h1, h2, h3);

		pane.setCenter(v1);

		ImageView view = new ImageView(new Image(new FileInputStream("loginAddmin.jpeg")));
		view.setFitHeight(550);
		view.setFitWidth(550);

		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		Scene scene = new Scene(stack, 600, 600);
		stage2.setScene(scene);
		stage2.show();

		prev.setOnAction((ActionEvent e) -> {
			stage2.close();
			primaryStage.show();

		});

		login.setOnAction((ActionEvent e) -> {
			try {
				connectDB();
				String SQL;
				// System.out.println("Connection established");
				Statement stmt = con.createStatement();

				SQL = "select * from " + table + " where Email='" + tUser.getText().toString().trim()
						+ "' and password ='" + tPass.getText().toString().trim() + "' and rankEmp = '" + kind + "'";

				ResultSet rs = stmt.executeQuery(SQL);

				if (rs.next()) {
					try {
						JOptionPane.showMessageDialog(null, "Login sucessfuly");
						stage2.close();
						if (kind.equals("Admin"))
							WorkOfAdmin(stage2);
						else if (kind.equals("Employee"))
							WorkOfEmployee(stage2);

					} catch (Exception e1) {
						e1.printStackTrace();
					}
				} else
					JOptionPane.showMessageDialog(null, "incorrect username and password :)");

				rs.close();
				stmt.close();
				con.close();
			} catch (ClassNotFoundException | SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});
	}

	/****************************** done **********************************/
	public static void DonorLogin(Stage primaryStage) throws FileNotFoundException {
		// Employee Login

		DropShadow shadow = new DropShadow(10, Color.RED);
		StackPane stack = new StackPane();

		BorderPane pane = new BorderPane();
		Label Username = new Label("Username");
		Label Password = new Label("Password");
		Password.setFont(Font.font("", FontWeight.BOLD, 18));
		Username.setFont(Font.font("", FontWeight.BOLD, 18));
		Password.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));
		Username.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));

		TextField tUser = new TextField();
		PasswordField tPass = new PasswordField();
		tUser.setFont(Font.font("", FontWeight.BOLD, 12));
		tPass.setFont(Font.font("", FontWeight.BOLD, 12));

		HBox h1 = new HBox();
		h1.setSpacing(10);
		h1.setAlignment(Pos.CENTER);
		h1.getChildren().addAll(Username, tUser);

		HBox h2 = new HBox();
		h2.setSpacing(10);
		h2.setAlignment(Pos.CENTER);
		h2.getChildren().addAll(Password, tPass);

		ImageView viewLogin = new ImageView(new Image(new FileInputStream("login.png")));
		ImageView viewPrev = new ImageView(new Image(new FileInputStream("Logout.png")));
		ImageView viewS = new ImageView(new Image(new FileInputStream("Add new.png")));

		Button login = new Button("Login", viewLogin);
		Button signUp = new Button("Sign Up", viewS);
		Button prev = new Button("Back", viewPrev);
		prev.setFont(Font.font("", FontWeight.BOLD, 15));
		signUp.setFont(Font.font("", FontWeight.BOLD, 15));
		login.setFont(Font.font("", FontWeight.BOLD, 15));
		login.setEffect(shadow);
		signUp.setEffect(shadow);
		prev.setEffect(shadow);

		HBox h3 = new HBox();
		h3.setSpacing(15);
		h3.setAlignment(Pos.CENTER);
		h3.getChildren().addAll( prev,login, signUp);
		h3.setPadding(new Insets(10));

		VBox v1 = new VBox();
		v1.setSpacing(10);
		v1.setAlignment(Pos.CENTER);
		v1.getChildren().addAll(h1, h2, h3);

		pane.setCenter(v1);

		ImageView view = new ImageView(new Image(new FileInputStream("loginAddmin.jpeg")));
		view.setFitHeight(550);
		view.setFitWidth(550);

		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		Scene scene = new Scene(stack, 600, 600);
		stage2.setScene(scene);
		stage2.show();

		prev.setOnAction((ActionEvent e) -> {
			stage2.close();
			primaryStage.show();

		});

		login.setOnAction((ActionEvent e) -> {
			try {
				connectDB();
				String SQL;
				// System.out.println("Connection established");
				Statement stmt = con.createStatement();
				SQL = "select * from donor where Email='" + tUser.getText().toString().trim() + "' and password ='"
						+ tPass.getText().toString().trim() + "'";

				ResultSet rs = stmt.executeQuery(SQL);

				if (rs.next()) {
					try {
						JOptionPane.showMessageDialog(null, "Login sucessfuly");
						stage2.close();
						WorkOfDonor(primaryStage);
					} catch (Exception e1) {

						e1.printStackTrace();
					}
				} else
					JOptionPane.showMessageDialog(null, "incorrect username and password :)");

				rs.close();
				stmt.close();
				con.close();
			} catch (ClassNotFoundException | SQLException e1) {
				e1.printStackTrace();
			}

		});
		
		
		signUp.setOnAction((ActionEvent e) -> {
			stage2.close();
			  try {
				signUpdonor(primaryStage);
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			

		});
	}
	
	public static void signUpdonor(Stage primaryStage) throws FileNotFoundException {
		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Add NEW DONOR");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Donor");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		Label resID = new Label("......");
		resID.setFont(Font.font("", FontWeight.BOLD, 15));
		resID.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label name = new Label("Full NAme");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("Age Donor");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("Gender");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label bloodType = new Label("Blood Type");
		bloodType.setFont(Font.font("", FontWeight.BOLD, 15));
		bloodType.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		/*Label helthIssues = new Label("Helth Issues");
		helthIssues.setFont(Font.font("", FontWeight.BOLD, 15));
		helthIssues
				.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));*/

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		ComboBox<String> Cgender = new ComboBox<>();
		Cgender.setPrefSize(155, 30);
		Cgender.getItems().addAll("F", "M");

		ComboBox<String> Ctype = new ComboBox<>();
		Ctype.getItems().addAll("A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-");
		Ctype.setPrefSize(130, 30);

		/*TextField tHelthIssues = new TextField();
		tHelthIssues.setFont(Font.font("", FontWeight.BLACK, 12));*/
		
		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));
		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));
		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);
		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, Cgender);

		HBox hType = new HBox();
		hType.setSpacing(50);
		hType.setAlignment(Pos.TOP_CENTER);
		hType.getChildren().addAll(bloodType, Ctype);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, hType, hEmail, hPass, hAddres,
				hPhone, new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("save.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button save = new Button("Save", viewSave);
		save.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(save, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(400);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			ResultSet rs = stmt.executeQuery("select max(idDowner) from donor");
			if (rs.first()) {
				int Id = rs.getInt(1);
				Id = Id + 1;
				String str = String.valueOf(Id);
				resID.setText(str);
			} else
				resID.setText("1");

			save.setOnAction((ActionEvent e) -> {
				try {

					String donorId = resID.getText().toString();
					String nameD = tName.getText().toString();
					String ageD = tAge.getText().toString();
					String genderD = Cgender.getSelectionModel().getSelectedItem().toString().trim();
					String typeD = Ctype.getSelectionModel().getSelectedItem().toString().trim();

					String helthIssuesD = "  ";
					String EmailD = tEmail.getText().toString();
					String passD = tPass.getText().toString();
					String addressD = tAddress.getText().toString();
					String phoneD = tPhone.getText().toString();

					Statement st2 = con.createStatement();
					st2.executeUpdate("insert into donor values('" + donorId + "','" + nameD + "','" + ageD + "','"
							+ genderD + "','" + typeD + "','" + helthIssuesD + "','" + EmailD + "','" + passD + "','"
							+ addressD + "','" + phoneD + "')");
					JOptionPane.showMessageDialog(null, "Successfully Adding :) ");
					stage2.close();

					tName.setText(null);
					tAge.setText(null);
					Cgender.setSelectionModel(null);
					Ctype.setSelectionModel(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

					stage2.close();
					DonorLogin(stage2);

				} catch (SQLException e1) {
					e1.printStackTrace();
				} catch (FileNotFoundException e1) {
					// TODO Auto-generated catch block
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				Ctype.setSelectionModel(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				Ctype.setSelectionModel(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

		
	}
	
	public static void WorkOfDonor(Stage primaryStage) throws FileNotFoundException {
		StackPane stack = new StackPane();
		BorderPane pane = new BorderPane();
		DropShadow shadow = new DropShadow(10, Color.RED);

		
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(600);
		view.setFitWidth(600);
		
		Button donation = new Button("Donation");
		donation.setEffect(shadow);
		donation.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));
		donation.setFont(Font.font("", FontWeight.BOLD, 18));

		Button Update = new Button("Update Data");
		Update.setEffect(shadow);
		Update.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));
		Update.setFont(Font.font("", FontWeight.BOLD, 18));
		
		Button prev = new Button("Back");
		prev.setEffect(shadow);
		prev.setBackground(new Background(new BackgroundFill(Color.BEIGE, new CornerRadii(5), Insets.EMPTY)));
		prev.setFont(Font.font("", FontWeight.BOLD, 18));

		HBox h1 = new HBox();
		h1.setSpacing(10);
		h1.setAlignment(Pos.CENTER);
		h1.getChildren().addAll(prev, donation, Update);

		pane.setCenter(h1);
		
		
			
		Stage stage2 = new Stage();
		stack.getChildren().addAll(view, pane);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
		
		prev.setOnAction((ActionEvent e) -> {
			stage2.close();
			primaryStage.show();

		});
		
		donation.setOnAction((ActionEvent e) -> {
			int a = JOptionPane.showConfirmDialog(null, "Have you ever donated blood?", "Selection",
					JOptionPane.YES_NO_OPTION);
			if (a != 0) {
				JOptionPane.showMessageDialog(null, "You must visit the blood bank for the withdrawal process to be completed successfully, waiting for you from Sunday morning from 9 am to 4 pm ");
				stage2.close();
				stage2.show();
			}
				
			else {
				int b = JOptionPane.showConfirmDialog(null, "Has it been 6 months since your donation?", "Selection",
						JOptionPane.YES_NO_OPTION);
				if (b != 0) {
					JOptionPane.showMessageDialog(null, "Sorry, you cannot donate because one of the conditions for the donation is that your previous donation must have passed at least 6 months ");
				    stage2.close();
				    stage2.show();
				}
					
				else {
					JOptionPane.showMessageDialog(null, "You must visit the blood bank for the withdrawal process to be completed successfully, waiting for you from Sunday morning from 9 am to 4 pm ");
					stage2.close();
					stage2.show();
				}
					
			}
			
		});
		
		
		Update.setOnAction((ActionEvent e) -> {
			try {
				UpdateDonor();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
			
		});
	
			
		
	}
	
	
	/****************************** done **********************************/
	public static void WorkOfAdmin(Stage primaryStage) throws FileNotFoundException {
		StackPane stack = new StackPane();
		BorderPane pane = new BorderPane();
		MenuBar menuBar = new MenuBar();

		ImageView donor = new ImageView(new Image(new FileInputStream("Donor.png")));
		ImageView ADD = new ImageView(new Image(new FileInputStream("Add new.png")));
		ImageView ADD2 = new ImageView(new Image(new FileInputStream("Add new.png")));
		ImageView update = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView update2 = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView all = new ImageView(new Image(new FileInputStream("Details.png")));
		ImageView all2 = new ImageView(new Image(new FileInputStream("Details.png")));

		Menu Donor = new Menu("", donor);
		MenuItem AddNew = new MenuItem("Add new Donor", ADD);
		MenuItem AddNewEmp = new MenuItem("Add new Employee", ADD2);
		MenuItem Update = new MenuItem("Update Details Donor", update);
		MenuItem UpdateEmp = new MenuItem("Update Details Employee", update2);
		MenuItem All = new MenuItem("All Donor Details", all);
		MenuItem AllEmp = new MenuItem("All Employee Details", all2);
		Donor.getItems().addAll(new SeparatorMenuItem(), AddNew, Update, All, new SeparatorMenuItem(), AddNewEmp,
				UpdateEmp, AllEmp, new SeparatorMenuItem());

		/****************************************************************************************************************/
		ImageView viewS = new ImageView(new Image(new FileInputStream("stock.png")));
		ImageView viewI = new ImageView(new Image(new FileInputStream("Inc.png")));
		ImageView viewD = new ImageView(new Image(new FileInputStream("Dec.png")));
		ImageView viewDD = new ImageView(new Image(new FileInputStream("Details.png")));

		Menu stock = new Menu("Stock", viewS);
		MenuItem incre = new MenuItem("increase", viewI);
		MenuItem decre = new MenuItem("Decrease", viewD);
		MenuItem details = new MenuItem("Details", viewDD);
		stock.getItems().addAll(new SeparatorMenuItem(), incre, decre, details);

		/**************************************************************************************************************/
		ImageView d = new ImageView(new Image(new FileInputStream("delete donor.png")));
		ImageView dD = new ImageView(new Image(new FileInputStream("delete.png")));
		ImageView dD2 = new ImageView(new Image(new FileInputStream("delete.png")));

		Menu deleteDonor = new Menu("", d);
		MenuItem delete = new MenuItem("Delete Donor", dD);
		MenuItem deleteEmp = new MenuItem("Delete Employee", dD2);
		deleteDonor.getItems().addAll(new SeparatorMenuItem(), delete, new SeparatorMenuItem(), deleteEmp,
				new SeparatorMenuItem());

		/****************************************************************************************************************/
		ImageView sD = new ImageView(new Image(new FileInputStream("search user.png")));
		ImageView lD = new ImageView(new Image(new FileInputStream("Location.png")));
		ImageView bD = new ImageView(new Image(new FileInputStream("Blood group.png")));
		Menu search = new Menu("Search Blood Donor", sD);
		MenuItem Location = new MenuItem("Location", lD);
		MenuItem BloodGroup = new MenuItem("Blood Group", d = bD);
		search.getItems().addAll(Location, BloodGroup);

		/****************************************************************************************************************/

		ImageView exitview = new ImageView(new Image(new FileInputStream("exit.png")));
		ImageView logout = new ImageView(new Image(new FileInputStream("Logout.png")));
		ImageView exitall = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Menu Exit = new Menu("Exit", exitview);
		MenuItem Logout = new MenuItem("LogOut", logout);
		MenuItem ExitAll = new MenuItem("Exit All Application", exitall);
		Exit.getItems().addAll(Logout, ExitAll);

		/****************************************************************************************************************/
		menuBar.getMenus().addAll(Donor, deleteDonor, search, stock, Exit);
		pane.setTop(menuBar);

		AddNew.setOnAction((ActionEvent e) -> {
			try {
				AddDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}
		});

		Update.setOnAction((ActionEvent e) -> {
			try {
				UpdateDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}

		});

		All.setOnAction((ActionEvent e) -> {
			try {
				detailsOfDonor();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (ClassNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});

		AllEmp.setOnAction((ActionEvent e) -> {
			try {
				detailsOfEmp();
			} catch (FileNotFoundException | ClassNotFoundException | SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		delete.setOnAction((ActionEvent e) -> {
			try {
				deletDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}
		});

		Location.setOnAction((ActionEvent e) -> {
			try {
				Location();
			} catch (Exception e1) {
				e1.printStackTrace();
			}
		});

		BloodGroup.setOnAction((ActionEvent e) -> {
			try {
				BloodGroup();
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		incre.setOnAction((ActionEvent e) -> {
			try {
				String s1 = "update stock set unit=unit+ '";
				increaseAndDecreasing(s1);
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		decre.setOnAction((ActionEvent e) -> {
			try {
				String s1 = "update stock set unit=unit- '";
				increaseAndDecreasing(s1);
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		details.setOnAction((ActionEvent e) -> {
			try {
				DetailsOfBlood();
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		/****************************************************************************************************************/
		ImageView view = new ImageView(new Image(new FileInputStream("home.png")));
		view.setFitHeight(600);
		view.setFitWidth(1200);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		Scene scene = new Scene(stack, 1200, 600);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************************/

		Logout.setOnAction((ActionEvent e) -> {
			int a = JOptionPane.showConfirmDialog(null, "Do you need realy want to Exit from this page", "Selection",
					JOptionPane.YES_NO_OPTION);
			if (a == 0)
				stage2.close();
			primaryStage.show();
		});

		ExitAll.setOnAction((ActionEvent e) -> {
			int a = JOptionPane.showConfirmDialog(null, "Do you need realy want to cloce All Applicaion", "Selection",
					JOptionPane.YES_NO_OPTION);
			if (a == 0)
				stage2.close();
		});

		UpdateEmp.setOnAction((ActionEvent e) -> {
			try {
				UpdateEmp();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});

		AddNewEmp.setOnAction((ActionEvent e) -> {
			try {
				AddEmp();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		deleteEmp.setOnAction((ActionEvent e) -> {
			try {
				deleteEmp();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

	}

	/****************************** done **********************************/
	public static void WorkOfEmployee(Stage primaryStage) throws FileNotFoundException {
		StackPane stack = new StackPane();
		BorderPane pane = new BorderPane();
		MenuBar menuBar = new MenuBar();

		ImageView donor = new ImageView(new Image(new FileInputStream("Donor.png")));
		ImageView ADD = new ImageView(new Image(new FileInputStream("Add new.png")));
		ImageView update = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView all = new ImageView(new Image(new FileInputStream("Details.png")));

		Menu Donor = new Menu("Donor", donor);
		MenuItem AddNew = new MenuItem("Add new", ADD);
		MenuItem Update = new MenuItem("Update Details", update);
		MenuItem All = new MenuItem("All Donor Details", all);
		Donor.getItems().addAll(new SeparatorMenuItem(), AddNew, Update, All);

		/****************************************************************************************************************/
		ImageView viewS = new ImageView(new Image(new FileInputStream("stock.png")));
		ImageView viewI = new ImageView(new Image(new FileInputStream("Inc.png")));
		ImageView viewD = new ImageView(new Image(new FileInputStream("Dec.png")));
		ImageView viewDD = new ImageView(new Image(new FileInputStream("Details.png")));

		Menu stock = new Menu("Stock", viewS);
		MenuItem incre = new MenuItem("increase", viewI);
		MenuItem decre = new MenuItem("Decrease", viewD);
		MenuItem details = new MenuItem("Details", viewDD);
		stock.getItems().addAll(new SeparatorMenuItem(), incre, decre, details);

		/**************************************************************************************************************/
		ImageView d = new ImageView(new Image(new FileInputStream("delete donor.png")));
		ImageView dD = new ImageView(new Image(new FileInputStream("delete.png")));
		Menu deleteDonor = new Menu("Delete Donor", d);
		MenuItem delete = new MenuItem("Delete Donor", dD);
		deleteDonor.getItems().add(delete);

		/****************************************************************************************************************/
		ImageView sD = new ImageView(new Image(new FileInputStream("search user.png")));
		ImageView lD = new ImageView(new Image(new FileInputStream("Location.png")));
		ImageView bD = new ImageView(new Image(new FileInputStream("Blood group.png")));
		Menu search = new Menu("Search Blood Donor", sD);
		MenuItem Location = new MenuItem("Location", lD);
		MenuItem BloodGroup = new MenuItem("Blood Group", d = bD);
		search.getItems().addAll(Location, BloodGroup);

		/****************************************************************************************************************/

		ImageView exitview = new ImageView(new Image(new FileInputStream("exit.png")));
		ImageView logout = new ImageView(new Image(new FileInputStream("Logout.png")));
		ImageView exitall = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Menu Exit = new Menu("Exit", exitview);
		MenuItem Logout = new MenuItem("LogOut", logout);
		MenuItem ExitAll = new MenuItem("Exit All Application", exitall);
		Exit.getItems().addAll(Logout, ExitAll);

		/****************************************************************************************************************/
		menuBar.getMenus().addAll(Donor, deleteDonor, search, stock, Exit);
		pane.setTop(menuBar);

		// UpdateEmp()

		AddNew.setOnAction((ActionEvent e) -> {
			/************ will done *****************/
			try {
				AddDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}
		});

		Update.setOnAction((ActionEvent e) -> {
			try {
				UpdateDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}

		});

		All.setOnAction((ActionEvent e) -> {
			// select all
			try {
				detailsOfDonor();
			} catch (FileNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (ClassNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});

		delete.setOnAction((ActionEvent e) -> {
			try {
				deletDonor();
			} catch (FileNotFoundException e1) {
				e1.printStackTrace();
			}
		});

		Location.setOnAction((ActionEvent e) -> {
			try {
				Location();
			} catch (Exception e1) {
				e1.printStackTrace();
			}
		});

		BloodGroup.setOnAction((ActionEvent e) -> {
			try {
				BloodGroup();
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		incre.setOnAction((ActionEvent e) -> {
			try {
				String s1 = "update stock set unit=unit+ '";
				increaseAndDecreasing(s1);
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		decre.setOnAction((ActionEvent e) -> {
			try {
				String s1 = "update stock set unit=unit- '";
				increaseAndDecreasing(s1);
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		details.setOnAction((ActionEvent e) -> {
			try {
				DetailsOfBlood();
			} catch (Exception e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}
		});

		/****************************************************************************************************************/
		ImageView view = new ImageView(new Image(new FileInputStream("home.png")));
		view.setFitHeight(600);
		view.setFitWidth(1200);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		Scene scene = new Scene(stack, 1200, 600);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************************/

		Logout.setOnAction((ActionEvent e) -> {
			int a = JOptionPane.showConfirmDialog(null, "Do you need realy want to Exit from this page", "Selection",
					JOptionPane.YES_NO_OPTION);
			if (a == 0)
				stage2.close();
			primaryStage.show();
		});

		ExitAll.setOnAction((ActionEvent e) -> {
			int a = JOptionPane.showConfirmDialog(null, "Do you need realy want to cloce All Applicaion", "Selection",
					JOptionPane.YES_NO_OPTION);
			if (a == 0)
				stage2.close();
		});

	}

	/****************************** done **********************************/

	public static void AddDonor() throws FileNotFoundException {
		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Add NEW DONOR");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Donor");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		Label resID = new Label("......");
		resID.setFont(Font.font("", FontWeight.BOLD, 15));
		resID.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label name = new Label("Full Donor");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("Age Donor");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("Gender");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label bloodType = new Label("Blood Type");
		bloodType.setFont(Font.font("", FontWeight.BOLD, 15));
		bloodType.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label helthIssues = new Label("Helth Issues");
		helthIssues.setFont(Font.font("", FontWeight.BOLD, 15));
		helthIssues
				.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		ComboBox<String> Cgender = new ComboBox<>();
		Cgender.setPrefSize(155, 30);
		Cgender.getItems().addAll("F", "M");

		ComboBox<String> Ctype = new ComboBox<>();
		Ctype.getItems().addAll("A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-");
		Ctype.setPrefSize(130, 30);

		TextField tHelthIssues = new TextField();
		tHelthIssues.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));
		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));
		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);
		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, Cgender);

		HBox hType = new HBox();
		hType.setSpacing(50);
		hType.setAlignment(Pos.TOP_CENTER);
		hType.getChildren().addAll(bloodType, Ctype);

		HBox hHelthIssues = new HBox();
		hHelthIssues.setSpacing(x);
		hHelthIssues.setAlignment(Pos.TOP_CENTER);
		hHelthIssues.getChildren().addAll(helthIssues, tHelthIssues);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, hType, hHelthIssues, hEmail, hPass, hAddres,
				hPhone, new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("save.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button save = new Button("Save", viewSave);
		save.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(save, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(400);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			ResultSet rs = stmt.executeQuery("select max(idDowner) from donor");
			if (rs.first()) {
				int Id = rs.getInt(1);
				Id = Id + 1;
				String str = String.valueOf(Id);
				resID.setText(str);
			} else
				resID.setText("1");

			save.setOnAction((ActionEvent e) -> {
				try {

					String donorId = resID.getText().toString();
					String nameD = tName.getText().toString();
					String ageD = tAge.getText().toString();
					String genderD = Cgender.getSelectionModel().getSelectedItem().toString().trim();
					String typeD = Ctype.getSelectionModel().getSelectedItem().toString().trim();

					String helthIssuesD = tHelthIssues.getText().toString();
					String EmailD = tEmail.getText().toString();
					String passD = tPass.getText().toString();
					String addressD = tAddress.getText().toString();
					String phoneD = tPhone.getText().toString();

					Statement st2 = con.createStatement();
					st2.executeUpdate("insert into donor values('" + donorId + "','" + nameD + "','" + ageD + "','"
							+ genderD + "','" + typeD + "','" + helthIssuesD + "','" + EmailD + "','" + passD + "','"
							+ addressD + "','" + phoneD + "')");
					JOptionPane.showMessageDialog(null, "Successfully Adding :) ");
					stage2.close();

					tName.setText(null);
					tAge.setText(null);
					Cgender.setSelectionModel(null);
					Ctype.setSelectionModel(null);
					tHelthIssues.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				Ctype.setSelectionModel(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				Ctype.setSelectionModel(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	/****************************** done **********************************/
	public static void AddEmp() throws FileNotFoundException {
		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Add NEW Employee");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Employee");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		Label resID = new Label("...");
		resID.setFont(Font.font("", FontWeight.BOLD, 15));
		resID.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label name = new Label("Full name ");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("     Age     ");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("Gender");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label rankEmp = new Label(" Rank is ?");
		rankEmp.setFont(Font.font("", FontWeight.BOLD, 15));
		rankEmp.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		ComboBox<String> Cgender = new ComboBox<>();
		Cgender.setPrefSize(155, 30);
		Cgender.getItems().addAll("F", "M");

		TextField tRankEmp = new TextField();
		tRankEmp.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));
		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));
		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);
		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, Cgender);

		HBox hRankEmp = new HBox();
		hRankEmp.setSpacing(50);
		hRankEmp.setAlignment(Pos.TOP_CENTER);
		hRankEmp.getChildren().addAll(rankEmp, tRankEmp);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, hRankEmp, hEmail, hPass, hAddres, hPhone,
				new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("save.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button save = new Button("Save", viewSave);
		save.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(save, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(400);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			ResultSet rs = stmt.executeQuery("select max(idEmployee) from employee");
			if (rs.first()) {
				int Id = rs.getInt(1);
				Id = Id + 1;
				String str = String.valueOf(Id);
				resID.setText(str);
			} else
				resID.setText("1");
			
			save.setOnAction((ActionEvent e) -> {
				try {
				
					
					String IdD = resID.getText().toString();
					String nameD = tName.getText().toString();
					String ageD = tAge.getText().toString();
					String genderD = Cgender.getSelectionModel().getSelectedItem().toString().trim();
					String tR = tRankEmp.getText().toString();

					String EmailD = tEmail.getText().toString();
					String passD = tPass.getText().toString();
					String addressD = tAddress.getText().toString();
					String phoneD = tPhone.getText().toString();

					Statement st2 = con.createStatement();
					st2.executeUpdate("insert into employee values('" + IdD + "','" + nameD + "','" + ageD + "','"
							+ genderD + "','" + tR + "','" + EmailD + "','" + passD + "','" + addressD + "','" + phoneD
							+ "')");
					JOptionPane.showMessageDialog(null, "Successfully Adding :) ");
					stage2.close();

					tName.setText(null);
					tAge.setText(null);
					Cgender.setSelectionModel(null);
					tRankEmp.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

				} catch (Exception e1) {
					e1.printStackTrace();
				} 

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				Cgender.setSelectionModel(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (Exception e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	/****************************** done **********************************/

	public static void detailsOfDonor() throws FileNotFoundException, SQLException, ClassNotFoundException {

		StackPane stack = new StackPane();
		BorderPane pane = new BorderPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));

		view.setFitHeight(400);
		view.setFitWidth(600);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);

		data = new ArrayList<>();
		// getData:
		connectDB();
		Statement stmt = con.createStatement();
		ResultSet rs = stmt.executeQuery("select * from donor ");
		while (rs.next())
			data.add(new Donor(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4), rs.getString(5),
					rs.getString(6), rs.getString(7), rs.getString(8), rs.getString(9), rs.getString(10)));

		rs.close();
		stmt.close();
		con.close();

		dataList = FXCollections.observableArrayList(data);// convert data from arraylist to observable arraylist

		tableView(pane, stage2);// really bad method

		stack.getChildren().addAll(view, pane);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
	}

	public static void detailsOfEmp() throws FileNotFoundException, SQLException, ClassNotFoundException {

		StackPane stack = new StackPane();
		BorderPane pane = new BorderPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));

		view.setFitHeight(400);
		view.setFitWidth(600);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);

		data3 = new ArrayList<>();
		// getData:
		connectDB();
		Statement stmt = con.createStatement();
		ResultSet rs = stmt.executeQuery("select * from employee ");
		while (rs.next())
			data3.add(new Employee(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4), rs.getString(5),
					rs.getString(6), rs.getString(7), rs.getString(9)));

		rs.close();
		stmt.close();
		con.close();

		dataList3 = FXCollections.observableArrayList(data3);// convert data from arraylist to observable arraylist

		tableView2(pane, stage2);// really bad method

		stack.getChildren().addAll(view, pane);
		Scene scene = new Scene(stack, 600, 400);
		stage2.setScene(scene);
		stage2.show();
	}
	@SuppressWarnings("unchecked")
	private static TableView<Donor> tableView(BorderPane pane, Stage stage) throws FileNotFoundException {

		TableView<Donor> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(200);
		myDataTable.setMaxWidth(500);

		TableColumn<Donor, String> idDownerCol = new TableColumn<Donor, String>("idDowner");
		idDownerCol.setMinWidth(100);
		idDownerCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("idDowner"));

		TableColumn<Donor, String> nameCol = new TableColumn<Donor, String>("name");
		nameCol.setMinWidth(100);
		nameCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("name"));

		TableColumn<Donor, String> ageCol = new TableColumn<Donor, String>("age");
		ageCol.setMinWidth(100);
		ageCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("age"));

		TableColumn<Donor, String> genderCol = new TableColumn<Donor, String>("gender");
		genderCol.setMinWidth(100);
		genderCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("gender"));

		TableColumn<Donor, String> bloodTypeCol = new TableColumn<Donor, String>("bloodType");
		bloodTypeCol.setMinWidth(100);
		bloodTypeCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("bloodType"));

		TableColumn<Donor, String> helthIssuesCol = new TableColumn<Donor, String>("helthIssues");
		helthIssuesCol.setMinWidth(100);
		helthIssuesCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("helthIssues"));

		TableColumn<Donor, String> EmailCol = new TableColumn<Donor, String>("Email");
		EmailCol.setMinWidth(100);
		EmailCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Email"));

		TableColumn<Donor, String> passwordCol = new TableColumn<Donor, String>("password");
		passwordCol.setMinWidth(100);
		passwordCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("password"));

		TableColumn<Donor, String> AddressCol = new TableColumn<Donor, String>("Address");
		AddressCol.setMinWidth(100);
		AddressCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Address"));

		TableColumn<Donor, String> phoneCol = new TableColumn<Donor, String>("phone");
		phoneCol.setMinWidth(100);
		phoneCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("phone"));

		myDataTable.setItems(dataList);
		myDataTable.getColumns().addAll(idDownerCol, nameCol, ageCol, genderCol, bloodTypeCol, helthIssuesCol, EmailCol,
				passwordCol, AddressCol, phoneCol);

		Label tital = new Label("All Donor Details");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(tital, myDataTable, close);
		pane.setCenter(v);

		close.setOnAction((ActionEvent e) -> {
			stage.close();
		});

		return myDataTable;

	}
	/****************************** done **********************************/
	@SuppressWarnings("unchecked")
	private static TableView<Employee> tableView2(BorderPane pane, Stage stage) throws FileNotFoundException {

		TableView<Employee> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(200);
		myDataTable.setMaxWidth(500);

		TableColumn<Employee, String> idEmployeeCol = new TableColumn<Employee, String>("idEmployee");
		idEmployeeCol.setMinWidth(100);
		idEmployeeCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("idEmployee"));
		
		TableColumn<Employee, String> nameEmployeeCol = new TableColumn<Employee, String>("nameEmployee");
		nameEmployeeCol.setMinWidth(100);
		nameEmployeeCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("nameEmployee"));
		
		TableColumn<Employee, String> ageCol = new TableColumn<Employee, String>("age");
		ageCol.setMinWidth(100);
		ageCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("age"));
		
		TableColumn<Employee, String> genderCol = new TableColumn<Employee, String>("gender");
		genderCol.setMinWidth(100);
		genderCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("gender"));
		
		TableColumn<Employee, String> adressCol = new TableColumn<Employee, String>("adress");
		adressCol.setMinWidth(100);
		adressCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("adress"));
		
		TableColumn<Employee, String> phoneCol = new TableColumn<Employee, String>("phone");
		phoneCol.setMinWidth(100);
		phoneCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("phone"));
		
		TableColumn<Employee, String> emailCol = new TableColumn<Employee, String>("email");
		emailCol.setMinWidth(110);
		emailCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("email"));
		
		TableColumn<Employee, String> rankEmpCol = new TableColumn<Employee, String>("rankEmp");
		rankEmpCol.setMinWidth(100);
		rankEmpCol.setCellValueFactory(new PropertyValueFactory<Employee, String>("rankEmp"));
		
		myDataTable.setItems(dataList3);
		myDataTable.getColumns().addAll(idEmployeeCol, nameEmployeeCol, ageCol, genderCol, adressCol,
				phoneCol, emailCol, rankEmpCol);

		Label tital = new Label("All Employee Details");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(tital, myDataTable, close);
		pane.setCenter(v);

		close.setOnAction((ActionEvent e) -> {
			stage.close();
		});

		return myDataTable;

	}

	/****************************** done **********************************/

	@SuppressWarnings("unchecked")
	private static void Location() throws FileNotFoundException, ClassNotFoundException, Exception {
		BorderPane pane = new BorderPane();
		ImageView viewb = new ImageView(new Image(new FileInputStream("Blood group.png")));
		Label tital = new Label("Serch Blood Donor (Address)", viewb);
		tital.setTextFill(Color.BLACK);
		tital.setFont(Font.font("", FontWeight.BOLD, 25));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));
		Label l = new Label("\n");
		VBox vv = new VBox();
		vv.setSpacing(10);
		vv.setAlignment(Pos.CENTER);
		vv.getChildren().addAll(l, tital);

		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(vv);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		ImageView view = new ImageView(new Image(new FileInputStream("Location.png")));
		Label add = new Label("Address", view);
		add.setTextFill(Color.BLACK);
		add.setFont(Font.font("", FontWeight.BOLD, 15));
		add.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField txt = new TextField();
		txt.setFont(Font.font("", FontWeight.BOLD, 13));
		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(add, txt, search);

		ImageView view2 = new ImageView(new Image(new FileInputStream("1.jpeg")));

		/****************************************************************************/
		Stage stage2 = new Stage();

		// tableView2(pane,stage2);// really bad method
		StackPane stack = new StackPane();
		view2.setFitHeight(430);
		view2.setFitWidth(600);
		stack.getChildren().addAll(view2, pane);
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();

		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		TableView<Donor> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(200);
		myDataTable.setMaxWidth(500);

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(h, myDataTable, close);
		pane.setCenter(v);

		close.setOnAction((ActionEvent e) -> {
			stage2.close();
		});

		search.setOnAction((ActionEvent e) -> {
			ObservableList<Donor> allDonor;
			allDonor = myDataTable.getItems();
			allDonor.forEach(allDonor::remove);

			data = new ArrayList<>();
			// getData:
			try {
				connectDB();
				Statement stmt = con.createStatement();
				ResultSet rs = stmt
						.executeQuery("select * from donor where Address like '%" + txt.getText().toString() + "%'");
				while (rs.next())
					data.add(new Donor(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4),
							rs.getString(5), rs.getString(6), rs.getString(7), rs.getString(8), rs.getString(9),
							rs.getString(10)));
				rs.close();
				stmt.close();
				con.close();
				dataList = FXCollections.observableArrayList(data);// convert data from arraylist to observable
																	// arraylist

				TableColumn<Donor, String> idDownerCol = new TableColumn<Donor, String>("idDowner");
				idDownerCol.setMinWidth(100);
				idDownerCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("idDowner"));

				TableColumn<Donor, String> nameCol = new TableColumn<Donor, String>("name");
				nameCol.setMinWidth(100);
				nameCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("name"));

				TableColumn<Donor, String> ageCol = new TableColumn<Donor, String>("age");
				ageCol.setMinWidth(100);
				ageCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("age"));

				TableColumn<Donor, String> genderCol = new TableColumn<Donor, String>("gender");
				genderCol.setMinWidth(100);
				genderCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("gender"));

				TableColumn<Donor, String> bloodTypeCol = new TableColumn<Donor, String>("bloodType");
				bloodTypeCol.setMinWidth(100);
				bloodTypeCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("bloodType"));

				TableColumn<Donor, String> helthIssuesCol = new TableColumn<Donor, String>("helthIssues");
				helthIssuesCol.setMinWidth(100);
				helthIssuesCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("helthIssues"));

				TableColumn<Donor, String> EmailCol = new TableColumn<Donor, String>("Email");
				EmailCol.setMinWidth(100);
				EmailCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Email"));

				TableColumn<Donor, String> passwordCol = new TableColumn<Donor, String>("password");
				passwordCol.setMinWidth(100);
				passwordCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("password"));

				TableColumn<Donor, String> AddressCol = new TableColumn<Donor, String>("Address");
				AddressCol.setMinWidth(100);
				AddressCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Address"));

				TableColumn<Donor, String> phoneCol = new TableColumn<Donor, String>("phone");
				phoneCol.setMinWidth(100);
				phoneCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("phone"));

				myDataTable.setItems(dataList);
				myDataTable.getColumns().addAll(idDownerCol, nameCol, ageCol, genderCol, bloodTypeCol, helthIssuesCol,
						EmailCol, passwordCol, AddressCol, phoneCol);

			} catch (ClassNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});

	}

	/****************************** done **********************************/
	@SuppressWarnings("unchecked")
	private static void BloodGroup() throws FileNotFoundException {
		
		
		BorderPane pane = new BorderPane();
		ImageView viewb = new ImageView(new Image(new FileInputStream("Blood group.png")));
		Label tital = new Label("Serch Blood Donor (Blood Group)", viewb);
		
		tital.setTextFill(Color.BLACK);
		tital.setFont(Font.font("", FontWeight.BOLD, 25));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));
		Label l = new Label("\n");
		VBox vv = new VBox();
		vv.setSpacing(10);
		vv.setAlignment(Pos.CENTER);
		vv.getChildren().addAll(l, tital);

		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(vv);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		ImageView view = new ImageView(new Image(new FileInputStream("Location.png")));
		Label add = new Label("Blood Type", view);
		add.setTextFill(Color.BLACK);
		add.setFont(Font.font("", FontWeight.BOLD, 15));
		add.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField txt = new TextField();
		txt.setFont(Font.font("", FontWeight.BOLD, 13));
		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(add, txt, search);

		ImageView view2 = new ImageView(new Image(new FileInputStream("1.jpeg")));

		/****************************************************************************/
		Stage stage2 = new Stage();

		// tableView2(pane,stage2);// really bad method
		StackPane stack = new StackPane();
		view2.setFitHeight(430);
		view2.setFitWidth(600);
		stack.getChildren().addAll(view2, pane);
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();

		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		TableView<Donor> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(200);
		myDataTable.setMaxWidth(500);

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(h, myDataTable, close);
		pane.setCenter(v);

		close.setOnAction((ActionEvent e) -> {
			stage2.close();
		});	
		
		/*******************************/
	

		search.setOnAction((ActionEvent e) -> {
			ObservableList<Donor> allDonor;
			allDonor = myDataTable.getItems();
			allDonor.forEach(allDonor::remove);

			data = new ArrayList<>();
			// getData:
			try {
				connectDB();
				Statement stmt = con.createStatement();
				ResultSet rs = stmt
						.executeQuery("select * from donor where bloodType like '" + txt.getText().toString() + "'");
				while (rs.next())
					data.add(new Donor(rs.getString(1), rs.getString(2), rs.getString(3), rs.getString(4),
							rs.getString(5), rs.getString(6), rs.getString(7), rs.getString(8), rs.getString(9),
							rs.getString(10)));
				rs.close();
				stmt.close();
				con.close();
				dataList = FXCollections.observableArrayList(data);// convert data from arraylist to observable
																	// arraylist

				TableColumn<Donor, String> idDownerCol = new TableColumn<Donor, String>("idDowner");
				idDownerCol.setMinWidth(100);
				idDownerCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("idDowner"));

				TableColumn<Donor, String> nameCol = new TableColumn<Donor, String>("name");
				nameCol.setMinWidth(100);
				nameCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("name"));

				TableColumn<Donor, String> ageCol = new TableColumn<Donor, String>("age");
				ageCol.setMinWidth(100);
				ageCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("age"));

				TableColumn<Donor, String> genderCol = new TableColumn<Donor, String>("gender");
				genderCol.setMinWidth(100);
				genderCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("gender"));

				TableColumn<Donor, String> bloodTypeCol = new TableColumn<Donor, String>("bloodType");
				bloodTypeCol.setMinWidth(100);
				bloodTypeCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("bloodType"));

				TableColumn<Donor, String> helthIssuesCol = new TableColumn<Donor, String>("helthIssues");
				helthIssuesCol.setMinWidth(100);
				helthIssuesCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("helthIssues"));

				TableColumn<Donor, String> EmailCol = new TableColumn<Donor, String>("Email");
				EmailCol.setMinWidth(100);
				EmailCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Email"));

				TableColumn<Donor, String> passwordCol = new TableColumn<Donor, String>("password");
				passwordCol.setMinWidth(100);
				passwordCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("password"));

				TableColumn<Donor, String> AddressCol = new TableColumn<Donor, String>("Address");
				AddressCol.setMinWidth(100);
				AddressCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("Address"));

				TableColumn<Donor, String> phoneCol = new TableColumn<Donor, String>("phone");
				phoneCol.setMinWidth(100);
				phoneCol.setCellValueFactory(new PropertyValueFactory<Donor, String>("phone"));

				myDataTable.setItems(dataList);
				myDataTable.getColumns().addAll(idDownerCol, nameCol, ageCol, genderCol, bloodTypeCol, helthIssuesCol,
						EmailCol, passwordCol, AddressCol, phoneCol);

			} catch (ClassNotFoundException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			} catch (SQLException e1) {
				// TODO Auto-generated catch block
				e1.printStackTrace();
			}

		});	
	}

	/****************************** done **********************************/
	@SuppressWarnings("unchecked")
	public static void increaseAndDecreasing(String s1)
			throws FileNotFoundException, ClassNotFoundException, SQLException {
		// data2 = new ArrayList<>();

		BorderPane pane = new BorderPane();

		Label tital = new Label("Stock");
		tital.setTextFill(Color.BLACK);
		tital.setFont(Font.font("", FontWeight.BOLD, 25));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		Label l = new Label("\n");
		VBox vv = new VBox();
		vv.setSpacing(10);
		vv.setAlignment(Pos.CENTER);
		vv.getChildren().addAll(l, tital);

		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(vv);

		ImageView viewb = new ImageView(new Image(new FileInputStream("Blood group.png")));
		Label type = new Label("Stock (blood Type)", viewb);
		type.setTextFill(Color.BLACK);
		type.setFont(Font.font("", FontWeight.BOLD, 15));
		type.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));

		ComboBox<String> Ctype = new ComboBox<>();
		Ctype.getItems().addAll("A+", "A-", "B+", "B-", "O+", "O-", "AB+", "AB-");
		Ctype.setPrefSize(90, 30);

		Label t = new Label("\t");

		Label unit = new Label("Units");
		unit.setTextFill(Color.BLACK);
		unit.setFont(Font.font("", FontWeight.BOLD, 15));
		unit.setBackground(new Background(new BackgroundFill(Color.LIGHTGREY, new CornerRadii(5), Insets.EMPTY)));

		TextField txt = new TextField();
		txt.setFont(Font.font("", FontWeight.BOLD, 13));
		txt.setPrefSize(90, 30);

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(type, Ctype, t, unit, txt);

		/*********************************************/
		data2 = new ArrayList<>();
		connectDB();
		Statement stmt = con.createStatement();
		ResultSet rs = stmt.executeQuery("select * from stock");
		while (rs.next())
			data2.add(new Stock(rs.getString(1), rs.getInt(2)));
		stmt.close();
		rs.close();
		con.close();
		dataList2 = FXCollections.observableArrayList(data2);

		// tablieview:

		TableView<Stock> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(230);
		myDataTable.setMaxWidth(250);

		TableColumn<Stock, String> bloodTypecol1 = new TableColumn<Stock, String>("bloodType");
		bloodTypecol1.setMinWidth(125);
		bloodTypecol1.setCellValueFactory(new PropertyValueFactory<Stock, String>("bloodType"));

		TableColumn<Stock, Integer> unitCol1 = new TableColumn<Stock, Integer>("unit");
		unitCol1.setMinWidth(125);
		unitCol1.setCellValueFactory(new PropertyValueFactory<Stock, Integer>("unit"));

		myDataTable.setItems(dataList2);
		myDataTable.getColumns().addAll(bloodTypecol1, unitCol1);

		VBox v = new VBox();
		v.setSpacing(10);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(h, myDataTable);

		ImageView view2 = new ImageView(new Image(new FileInputStream("2.jpeg")));
		Stage stage2 = new Stage();
		StackPane stack = new StackPane();
		view2.setFitHeight(430);
		view2.setFitWidth(600);
		stack.getChildren().addAll(view2, pane);
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();

		ImageView update = new ImageView(new Image(new FileInputStream("Update details.png")));
		Button updateB = new Button("update", update);
		updateB.setFont(Font.font("", FontWeight.BOLD, 15));

		ImageView closeV = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", closeV);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		HBox v2 = new HBox();
		v2.setSpacing(10);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(updateB, close);

		pane.setBottom(v2);
		pane.setCenter(v);

		close.setOnAction((ActionEvent e2) -> {
			stage2.close();
		});

		data2 = new ArrayList<>();
		updateB.setOnAction((ActionEvent e2) -> {

			/*
			 * ObservableList<Stock> allDonor; allDonor = myDataTable.getItems();
			 * allDonor.forEach(allDonor::remove);
			 */

			String typeBlood = Ctype.getSelectionModel().getSelectedItem().toString().trim();
			int unitInt = Integer.parseInt(txt.getText().toString());

			// getData:

			try {
				connectDB();
				Statement stmt2 = con.createStatement();
				// String s11="update stock set unit=unit+ '";

				stmt2.executeUpdate(s1 + unitInt + "' where bloodType = '" + typeBlood + "'");
				ResultSet rs2 = stmt2.executeQuery("select * from stock");

				while (rs2.next())
					data2.add(new Stock(rs2.getString(1), rs2.getInt(2)));

				stmt2.close();
				rs2.close();
				con.close();

				dataList2 = FXCollections.observableArrayList(data2);// convert data from arraylist to observable
																		// arraylist
				JOptionPane.showMessageDialog(null, "Successfully updating :) ");
				TableColumn<Stock, String> bloodTypecol = new TableColumn<Stock, String>("bloodType");
				bloodTypecol.setMinWidth(125);
				bloodTypecol.setCellValueFactory(new PropertyValueFactory<Stock, String>("bloodType"));

				TableColumn<Stock, Integer> unitCol = new TableColumn<Stock, Integer>("unit");
				unitCol.setMinWidth(125);
				unitCol.setCellValueFactory(new PropertyValueFactory<Stock, Integer>("unit"));

				myDataTable.setItems(dataList2);
				myDataTable.getColumns().addAll(bloodTypecol, unitCol);
				
				stage2.close();
				stage2.show();

			} catch (ClassNotFoundException | SQLException e) {
				// TODO Auto-generated catch block
				e.printStackTrace();
			}

			txt.setText(null);
		});

	}

	/****************************** done **********************************/
	@SuppressWarnings("unchecked")
	public static void DetailsOfBlood() throws FileNotFoundException, ClassNotFoundException, SQLException {
		// data2 = new ArrayList<>();

		BorderPane pane = new BorderPane();
		Label tital = new Label("Stock");
		tital.setTextFill(Color.BLACK);
		tital.setFont(Font.font("", FontWeight.BOLD, 25));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		Label l = new Label("\n");
		VBox vv = new VBox();
		vv.setSpacing(10);
		vv.setAlignment(Pos.CENTER);
		vv.getChildren().addAll(l, tital);

		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(vv);

		/*********************************************/
		data2 = new ArrayList<>();
		connectDB();
		Statement stmt = con.createStatement();
		ResultSet rs = stmt.executeQuery("select * from stock");
		while (rs.next())
			data2.add(new Stock(rs.getString(1), rs.getInt(2)));
		stmt.close();
		rs.close();
		con.close();
		dataList2 = FXCollections.observableArrayList(data2);

		// tablieview:

		TableView<Stock> myDataTable = new TableView<>();
		myDataTable.setEditable(true);
		myDataTable.setMaxHeight(230);
		myDataTable.setMaxWidth(250);

		TableColumn<Stock, String> bloodTypecol1 = new TableColumn<Stock, String>("bloodType");
		bloodTypecol1.setMinWidth(125);
		bloodTypecol1.setCellValueFactory(new PropertyValueFactory<Stock, String>("bloodType"));

		TableColumn<Stock, Integer> unitCol1 = new TableColumn<Stock, Integer>("unit");
		unitCol1.setMinWidth(125);
		unitCol1.setCellValueFactory(new PropertyValueFactory<Stock, Integer>("unit"));

		myDataTable.setItems(dataList2);
		myDataTable.getColumns().addAll(bloodTypecol1, unitCol1);

		ImageView view2 = new ImageView(new Image(new FileInputStream("2.jpeg")));
		Stage stage2 = new Stage();
		StackPane stack = new StackPane();
		view2.setFitHeight(430);
		view2.setFitWidth(600);
		stack.getChildren().addAll(view2, pane);
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();

		ImageView closeV = new ImageView(new Image(new FileInputStream("Exit application.png")));
		Button close = new Button("close", closeV);
		close.setFont(Font.font("", FontWeight.BOLD, 15));

		VBox v2 = new VBox();
		v2.setSpacing(10);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(close);

		pane.setBottom(v2);
		pane.setCenter(myDataTable);

		close.setOnAction((ActionEvent e) -> {
			stage2.close();
		});
	}

	private static void deletDonor() throws FileNotFoundException {

		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Delete DONOR ");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Donor:");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField resID = new TextField();
		resID.setFont(Font.font("", FontWeight.BOLD, 13));
		resID.setMaxWidth(100);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		Label name = new Label("Full Donor");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("Age Donor");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("Gender");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label bloodType = new Label("Blood Type");
		bloodType.setFont(Font.font("", FontWeight.BOLD, 15));
		bloodType.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label helthIssues = new Label("Helth Issues");
		helthIssues.setFont(Font.font("", FontWeight.BOLD, 15));
		helthIssues
				.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tgender = new TextField();
		tgender.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tType = new TextField();
		tType.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tHelthIssues = new TextField();
		tHelthIssues.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));
		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));
		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);
		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID, search);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, tgender);

		HBox hType = new HBox();
		hType.setSpacing(50);
		hType.setAlignment(Pos.TOP_CENTER);
		hType.getChildren().addAll(bloodType, tType);

		HBox hHelthIssues = new HBox();
		hHelthIssues.setSpacing(x);
		hHelthIssues.setAlignment(Pos.TOP_CENTER);
		hHelthIssues.getChildren().addAll(helthIssues, tHelthIssues);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, hType, hHelthIssues, hEmail, hPass, hAddres,
				hPhone, new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("delete.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button Delete = new Button("Delete", viewSave);
		Delete.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(Delete, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(430);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			search.setOnAction((ActionEvent e) -> {
				try {
					ResultSet rs = stmt
							.executeQuery("select * from donor where idDowner='" + resID.getText().toString() + "'");
					if (rs.next()) {
						tName.setText(rs.getString(2));
						tAge.setText(rs.getString(3));
						tgender.setText(rs.getString(4));
						tType.setText(rs.getString(5));
						tHelthIssues.setText(rs.getString(6));
						tEmail.setText(rs.getString(7));
						tPass.setText(rs.getString(8));
						tAddress.setText(rs.getString(9));
						tPhone.setText(rs.getString(10));
					} else
						JOptionPane.showMessageDialog(null, "Id Donoer does not Exist");
				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			// update date
			Delete.setOnAction((ActionEvent e) -> {
				try {

					Statement st2 = con.createStatement();
					st2.executeUpdate("delete from donor where idDowner='" + resID.getText().toString() + "'");
					JOptionPane.showMessageDialog(null, "Successfully Deleted");
					stage2.close();

					resID.setText(null);
					tName.setText(null);
					tAge.setText(null);
					tgender.setText(null);
					tType.setText(null);
					tHelthIssues.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

					stage2.show();

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				resID.setText(null);
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tType.setText(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tType.setText(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	private static void deleteEmp() throws FileNotFoundException {

		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Delete Emplpyee ");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Emplpyee:");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField resID = new TextField();
		resID.setFont(Font.font("", FontWeight.BOLD, 13));
		resID.setMaxWidth(100);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		Label name = new Label("Full name ");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("    Age    ");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("  Gender  ");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label rankEmp = new Label("  Rankis?  ");
		rankEmp.setFont(Font.font("", FontWeight.BOLD, 15));
		rankEmp.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tgender = new TextField();
		tgender.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tRankEmp = new TextField();
		tRankEmp.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));

		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));

		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);

		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID, search);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, tgender);

		HBox htRankEmp = new HBox();
		htRankEmp.setSpacing(50);
		htRankEmp.setAlignment(Pos.TOP_CENTER);
		htRankEmp.getChildren().addAll(rankEmp, tRankEmp);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, htRankEmp, hEmail, hPass, hAddres, hPhone,
				new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("delete.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button Delete = new Button("Delete", viewSave);
		Delete.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(Delete, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(430);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			search.setOnAction((ActionEvent e) -> {
				try {
					ResultSet rs = stmt.executeQuery("select * from employee where idEmployee='"
							+ Integer.parseInt(resID.getText().toString()) + "'");
					if (rs.next()) {
						tName.setText(rs.getString(2));
						tAge.setText(rs.getString(3));
						tgender.setText(rs.getString(4));
						tAddress.setText(rs.getString(5));
						tPhone.setText(rs.getString(6));
						tEmail.setText(rs.getString(7));
						tPass.setText(rs.getString(8));
						tRankEmp.setText(rs.getString(9));

					} else
						JOptionPane.showMessageDialog(null, "Id Emloyee does not Exist");
				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Delete.setOnAction((ActionEvent e) -> {
				try {

					Statement st2 = con.createStatement();
					st2.executeUpdate("delete from employee where idEmployee='"
							+ Integer.parseInt(resID.getText().toString()) + "'");
					JOptionPane.showMessageDialog(null, "Successfully Deleted");
					stage2.close();

					resID.setText(null);
					tName.setText(null);
					tAge.setText(null);
					tgender.setText(null);
					tRankEmp.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

					stage2.show();

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();
				resID.setText(null);
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	public static void UpdateDonor() throws FileNotFoundException {
		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Update DONOR Details");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Donor:");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField resID = new TextField();
		resID.setFont(Font.font("", FontWeight.BOLD, 13));
		resID.setMaxWidth(100);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		Label name = new Label("Full Donor");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("Age Donor");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("Gender");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label bloodType = new Label("Blood Type");
		bloodType.setFont(Font.font("", FontWeight.BOLD, 15));
		bloodType.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label helthIssues = new Label("Helth Issues");
		helthIssues.setFont(Font.font("", FontWeight.BOLD, 15));
		helthIssues
				.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tgender = new TextField();
		tgender.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tType = new TextField();
		tType.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tHelthIssues = new TextField();
		tHelthIssues.setFont(Font.font("", FontWeight.BLACK, 12));
		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));
		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));
		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);
		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID, search);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, tgender);

		HBox hType = new HBox();
		hType.setSpacing(50);
		hType.setAlignment(Pos.TOP_CENTER);
		hType.getChildren().addAll(bloodType, tType);

		HBox hHelthIssues = new HBox();
		hHelthIssues.setSpacing(x);
		hHelthIssues.setAlignment(Pos.TOP_CENTER);
		hHelthIssues.getChildren().addAll(helthIssues, tHelthIssues);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, hType, hHelthIssues, hEmail, hPass, hAddres,
				hPhone, new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("save.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button Update = new Button("Update", viewSave);
		Update.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(Update, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(430);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			search.setOnAction((ActionEvent e) -> {

				try {
					ResultSet rs = stmt
							.executeQuery("select * from donor where idDowner='" + resID.getText().toString() + "'");
					if (rs.next()) {
						tName.setText(rs.getString(2));
						tAge.setText(rs.getString(3));
						tgender.setText(rs.getString(4));
						tType.setText(rs.getString(5));
						tHelthIssues.setText(rs.getString(6));
						tEmail.setText(rs.getString(7));
						tPass.setText(rs.getString(8));
						tAddress.setText(rs.getString(9));
						tPhone.setText(rs.getString(10));
					} else
						JOptionPane.showMessageDialog(null, "Id Donoer does not Exist");

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			// update date
			Update.setOnAction((ActionEvent e) -> {
				try {

					String donorId = resID.getText().toString();
					String nameD = tName.getText().toString();
					String ageD = tAge.getText().toString();
					String genderD = tgender.getText().toString();
					String typeD = tType.getText().toString();
					String helthIssuesD = tHelthIssues.getText().toString();
					String EmailD = tEmail.getText().toString();
					String passD = tPass.getText().toString();
					String addressD = tAddress.getText().toString();
					String phoneD = tPhone.getText().toString();

					Statement st2 = con.createStatement();
					st2.executeUpdate("update donor set name='" + nameD + "', age='" + ageD + "',gender='" + genderD
							+ "',bloodType='" + typeD + "',helthIssues='" + helthIssuesD + "',Email='" + EmailD
							+ "',password='" + passD + "',Address='" + addressD + "',phone='" + phoneD
							+ "' where idDowner='" + donorId + "'");
					JOptionPane.showMessageDialog(null, "Successfully updating :) ");
					stage2.close();

					tName.setText(null);
					tAge.setText(null);
					tgender.setText(null);
					tType.setText(null);
					tHelthIssues.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tType.setText(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tType.setText(null);
				tHelthIssues.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	public static void UpdateEmp() throws FileNotFoundException {
		int x = 10;
		BorderPane pane = new BorderPane();
		// pane.setPadding(new Insets(20));
		Label tital = new Label("Update Emplpyee ");
		tital.setFont(Font.font("", FontWeight.BOLD, 22));
		tital.setBackground(new Background(new BackgroundFill(Color.LIGHTCORAL, new CornerRadii(5), Insets.EMPTY)));
		BorderPane.setAlignment(tital, Pos.TOP_CENTER);
		pane.setTop(tital);

		Label id = new Label("ID Emplpyee:");
		id.setFont(Font.font("", FontWeight.BOLD, 15));
		id.setBackground(new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));
		TextField resID = new TextField();
		resID.setFont(Font.font("", FontWeight.BOLD, 13));
		resID.setMaxWidth(100);

		ImageView viewSearch = new ImageView(new Image(new FileInputStream("search1.png")));
		Button search = new Button("Search", viewSearch);
		search.setFont(Font.font("", FontWeight.BOLD, 13));

		Label name = new Label("Full name ");
		name.setFont(Font.font("", FontWeight.BOLD, 15));
		name.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label age = new Label("    Age    ");
		age.setFont(Font.font("", FontWeight.BOLD, 15));
		age.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label gender = new Label("  Gender  ");
		gender.setFont(Font.font("", FontWeight.BOLD, 15));
		gender.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label address = new Label("    Address    ");
		address.setFont(Font.font("", FontWeight.BOLD, 15));
		address.setBackground(
				new Background(new BackgroundFill(Color.LIGHTSLATEGREY, new CornerRadii(5), Insets.EMPTY)));

		Label phone = new Label("    Phone     ");
		phone.setFont(Font.font("", FontWeight.BOLD, 15));
		phone.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		Label Email = new Label("    Email    ");
		Email.setFont(Font.font("", FontWeight.BOLD, 15));
		Email.setBackground(new Background(new BackgroundFill(Color.LIGHTSTEELBLUE, new CornerRadii(5), Insets.EMPTY)));

		Label pass = new Label(" Password ");
		pass.setFont(Font.font("", FontWeight.BOLD, 15));
		pass.setBackground(new Background(new BackgroundFill(Color.LIGHTSALMON, new CornerRadii(5), Insets.EMPTY)));

		Label rankEmp = new Label("  Rankis?  ");
		rankEmp.setFont(Font.font("", FontWeight.BOLD, 15));
		rankEmp.setBackground(new Background(new BackgroundFill(Color.LIGHTYELLOW, new CornerRadii(5), Insets.EMPTY)));

		TextField tName = new TextField();
		tName.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tAge = new TextField();
		tAge.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tgender = new TextField();
		tgender.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tRankEmp = new TextField();
		tRankEmp.setFont(Font.font("", FontWeight.BLACK, 12));

		TextField tEmail = new TextField();
		tEmail.setFont(Font.font("", FontWeight.BLACK, 12));

		PasswordField tPass = new PasswordField();
		tPass.setMaxSize(170, 50);
		tPass.setFont(Font.font("", FontWeight.BLACK, 12));

		TextArea tAddress = new TextArea();
		tAddress.setFont(Font.font("", FontWeight.BLACK, 12));
		tAddress.setMaxSize(160, 50);

		TextField tPhone = new TextField();
		tPhone.setFont(Font.font("", FontWeight.BLACK, 12));

		HBox hId = new HBox();
		hId.setSpacing(x);
		hId.setAlignment(Pos.TOP_CENTER);
		hId.getChildren().addAll(id, resID, search);

		HBox hName = new HBox();
		hName.setSpacing(x);
		hName.setAlignment(Pos.TOP_CENTER);
		hName.getChildren().addAll(name, tName);

		HBox hAge = new HBox();
		hAge.setSpacing(x);
		hAge.setAlignment(Pos.TOP_CENTER);
		hAge.getChildren().addAll(age, tAge);

		HBox hGender = new HBox();
		hGender.setSpacing(40);
		hGender.setAlignment(Pos.TOP_CENTER);
		hGender.getChildren().addAll(gender, tgender);

		HBox htRankEmp = new HBox();
		htRankEmp.setSpacing(50);
		htRankEmp.setAlignment(Pos.TOP_CENTER);
		htRankEmp.getChildren().addAll(rankEmp, tRankEmp);

		HBox hEmail = new HBox();
		hEmail.setSpacing(20);
		hEmail.setAlignment(Pos.TOP_CENTER);
		hEmail.getChildren().addAll(Email, tEmail);

		HBox hPass = new HBox();
		hPass.setSpacing(20);
		hPass.setAlignment(Pos.TOP_CENTER);
		hPass.getChildren().addAll(pass, tPass);

		HBox hAddres = new HBox();
		hAddres.setSpacing(x);
		hAddres.setAlignment(Pos.TOP_CENTER);
		hAddres.getChildren().addAll(address, tAddress);

		HBox hPhone = new HBox();
		hPhone.setSpacing(x);
		hPhone.setAlignment(Pos.TOP_CENTER);
		hPhone.getChildren().addAll(phone, tPhone);

		VBox v = new VBox();
		v.setSpacing(3);
		v.setAlignment(Pos.CENTER);
		v.getChildren().addAll(new Label(), hId, hName, hAge, hGender, htRankEmp, hEmail, hPass, hAddres, hPhone,
				new Label());
		BorderPane.setAlignment(v, Pos.CENTER);
		pane.setCenter(v);

		ImageView viewSave = new ImageView(new Image(new FileInputStream("save.png")));
		ImageView viewReset = new ImageView(new Image(new FileInputStream("Update details.png")));
		ImageView viewClose = new ImageView(new Image(new FileInputStream("Exit application.png")));

		Button update = new Button("update", viewSave);
		update.setFont(Font.font("", FontWeight.BOLD, 13));

		Button Reset = new Button("Reset", viewReset);
		Reset.setFont(Font.font("", FontWeight.BOLD, 13));

		Button close = new Button("close", viewClose);
		close.setFont(Font.font("", FontWeight.BOLD, 13));

		HBox h = new HBox();
		h.setSpacing(10);
		h.setAlignment(Pos.CENTER);
		h.getChildren().addAll(update, Reset, close);

		VBox v2 = new VBox();
		v2.setSpacing(5);
		v2.setAlignment(Pos.CENTER);
		v2.getChildren().addAll(h, new Label());
		BorderPane.setAlignment(v2, Pos.CENTER);

		pane.setBottom(v2);

		/**************************************************************************************************/
		StackPane stack = new StackPane();
		ImageView view = new ImageView(new Image(new FileInputStream("2.jpeg")));
		view.setFitHeight(430);
		view.setFitWidth(600);
		stack.getChildren().addAll(view, pane);
		Stage stage2 = new Stage();
		stage2.setX(377);
		stage2.setY(127);
		Scene scene = new Scene(stack, 600, 430);
		stage2.setScene(scene);
		stage2.show();
		/****************************************************************************************************/

		try {
			connectDB();
			Statement stmt = con.createStatement();
			search.setOnAction((ActionEvent e) -> {

				try {
					ResultSet rs = stmt.executeQuery(
							"select * from employee where idEmployee='" + resID.getText().toString().trim() + "'");
					if (rs.next()) {
						tName.setText(rs.getString(2));
						tAge.setText(rs.getString(3));
						tgender.setText(rs.getString(4));
						tAddress.setText(rs.getString(5));
						tPhone.setText(rs.getString(6));
						tEmail.setText(rs.getString(7));
						tPass.setText(rs.getString(8));
						tRankEmp.setText(rs.getString(9));
					} else
						JOptionPane.showMessageDialog(null, "Id Employee does not Exist");

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			// update date
			update.setOnAction((ActionEvent e) -> {
				try {

					String Id = resID.getText().toString();
					String nameD = tName.getText().toString();
					String ageD = tAge.getText().toString();
					String genderD = tgender.getText().toString();
					String tR = tRankEmp.getText().toString();
					String EmailD = tEmail.getText().toString();
					String passD = tPass.getText().toString();
					String addressD = tAddress.getText().toString();
					String phoneD = tPhone.getText().toString();

					Statement st2 = con.createStatement();
					st2.executeUpdate("update employee set nameEmployee='" + nameD + "', age='" + ageD + "',gender='"
							+ genderD + "',Adress='" + addressD + "',phone='" + phoneD + "',Email='" + EmailD
							+ "',password='" + passD + "',rankEmp='" + tR + "' where idEmployee='" + Id + "'");
					JOptionPane.showMessageDialog(null, "Successfully updating :) ");
					stage2.close();

					tName.setText(null);
					tAge.setText(null);
					tgender.setText(null);
					tRankEmp.setText(null);
					tEmail.setText(null);
					tPass.setText(null);
					tAddress.setText(null);
					tPhone.setText(null);

				} catch (SQLException e1) {
					e1.printStackTrace();
				}

			});

			Reset.setOnAction((ActionEvent e) -> {
				stage2.close();

				resID.setText(null);
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);

				stage2.show();

			});

			close.setOnAction((ActionEvent e) -> {
				resID.setText(null);
				tName.setText(null);
				tAge.setText(null);
				tgender.setText(null);
				tRankEmp.setText(null);
				tEmail.setText(null);
				tPass.setText(null);
				tAddress.setText(null);
				tPhone.setText(null);
				stage2.close();
			});

		} catch (ClassNotFoundException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		} catch (SQLException e) {
			// TODO Auto-generated catch block
			e.printStackTrace();
		}

	}

	

}
