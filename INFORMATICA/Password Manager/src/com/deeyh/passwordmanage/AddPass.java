package com.deeyh.passwordmanage;

import java.awt.EventQueue;
import java.awt.Font;

import javax.swing.JButton;
import javax.swing.JFrame;
import javax.swing.JLabel;
import javax.swing.JTextField;
import javax.swing.JPasswordField;
import javax.swing.JCheckBox;
import java.awt.event.ActionListener;
import java.awt.event.ActionEvent;
import java.awt.event.MouseAdapter;
import java.awt.event.MouseEvent;
import java.io.FileWriter;
import java.io.IOException;
import java.io.PrintWriter;
import java.awt.event.KeyAdapter;
import java.awt.event.KeyEvent;

public class AddPass extends MainWindow{

	public JFrame frame;
	public JTextField textField;
	public JPasswordField passwordField;

	/**
	 * Launch the application.
	 */
	

	/**
	 * Create the application.
	 */
	public AddPass() {
		initialize();
	}

	/**
	 * Initialize the contents of the frame.
	 */
	public void initialize() {
		frame = new JFrame();
		frame.setBounds(100, 100, 623, 441);
		frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
		frame.getContentPane().setLayout(null);
		
		
		JLabel lblNewLabel = new JLabel("ADD PASSWORD");
		lblNewLabel.setFont(new Font("Century", Font.PLAIN, 40));
		lblNewLabel.setBounds(147, 0, 343, 80);
		frame.getContentPane().add(lblNewLabel);
		
		textField = new JTextField();
		textField.addKeyListener(new KeyAdapter() {
			public void keyTyped(KeyEvent e) {
				String sito_app = textField.getText();
			}
		});
		textField.setFont(new Font("Tahoma", Font.PLAIN, 30));
		textField.setBounds(40, 124, 385, 64);
		frame.getContentPane().add(textField);
		textField.setColumns(10);
		
		
		JButton btnExit = new JButton("EXIT");
		btnExit.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnExit.setBounds(497, 357, 102, 37);
		frame.getContentPane().add(btnExit);
		btnExit.addActionListener(new ActionListener() {
		      @Override
		      public void actionPerformed(ActionEvent e) {
		        System.exit(0);
		      }
		    });

		JLabel lblSitoapp = new JLabel("SITO/APP");
		lblSitoapp.setFont(new Font("Century", Font.PLAIN, 18));
		lblSitoapp.setBounds(40, 91, 102, 42);
		frame.getContentPane().add(lblSitoapp);
		
		JLabel lblPassword = new JLabel("PASSWORD");
		lblPassword.setFont(new Font("Century", Font.PLAIN, 18));
		lblPassword.setBounds(40, 199, 143, 42);
		frame.getContentPane().add(lblPassword);
		
		passwordField = new JPasswordField();
		passwordField.setFont(new Font("Tahoma", Font.PLAIN, 30));
		passwordField.setBounds(40, 234, 385, 64);
		frame.getContentPane().add(passwordField);
		
		
		
		
		JCheckBox chckbxNewCheckBox = new JCheckBox("SHOW PASSWORD");
		chckbxNewCheckBox.addMouseListener(new MouseAdapter() {
			boolean isChecked = false;
			@Override
			public void mouseClicked(MouseEvent e) {
				if(!isChecked) {
					passwordField.setEchoChar((char)0);
					isChecked = true;
				}
				else
				{
					isChecked = false;
					passwordField.setEchoChar('*');
				}
			}
		});
		chckbxNewCheckBox.setBounds(292, 298, 163, 28);
		frame.getContentPane().add(chckbxNewCheckBox);
		
		
		JButton btnAdd = new JButton("ADD");
		btnAdd.addActionListener(new ActionListener() {
			public void actionPerformed(ActionEvent e) {
				JLabel lblNewLabel_1 = new JLabel("");
				lblNewLabel_1.setFont(new Font("Tahoma", Font.PLAIN, 14));
				lblNewLabel_1.setBounds(40, 319, 185, 28);
				frame.getContentPane().add(lblNewLabel_1);
				Manager mn = new Manager();
				lblNewLabel_1.setText(mn.manager(textField.getText(), passwordField.getText()));
				
				
			}
		});
		btnAdd.setFont(new Font("Microsoft YaHei", Font.PLAIN, 20));
		btnAdd.setBounds(10, 357, 102, 37);
		frame.getContentPane().add(btnAdd);
		
		
		
	}
}


