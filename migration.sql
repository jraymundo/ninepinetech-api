--
-- Table structure for table `vehicles`
--
CREATE TABLE vehicles(
  id SERIAL,
  unique_identifier VARCHAR(17) UNIQUE,
  name VARCHAR(150),
  engine_displacement VARCHAR(255),
  engine_power VARCHAR(255),
  price float DEFAULT 0.00,
  location VARCHAR(100),
  created_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP WITH TIME ZONE NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);
