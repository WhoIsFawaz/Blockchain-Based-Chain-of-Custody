# 🔒 Blockchain-Based Chain of Custody (B-COC)  
🚨 **Revolutionizing Evidence Management for Law Enforcement**  

The **Blockchain-Based Chain of Custody (B-COC)** is an innovative system designed for police forces and government sectors to securely manage and track investigative artifacts. By leveraging blockchain technology, B-COC ensures tamper-proof records, transparency, and accountability throughout the lifecycle of evidence handling. 📜✨  

---

## 🏆 Project Overview  

### **Purpose**  
Eliminate outdated paper-based Chain of Custody (CoC) systems by adopting a blockchain-powered solution that tracks the creation, transfer, and return of artifacts in real-time.  

### **Key Stakeholders**  
- **Admin**:  
  Manages and assigns artifacts, ensuring each artifact gets a unique blockchain instance running on its own port.  
- **Police Officers**:  
  Handles check-out and check-in of artifacts, with every action recorded as an immutable blockchain entry.  

---

## 🌟 Features  

### 1. **Decentralized Blockchain Instances**  
- Each artifact operates on a dedicated blockchain instance, hosted on a unique port, ensuring isolated and secure tracking.  

### 2. **Immutable Records**  
- Every transaction (check-in or check-out) generates a new block, recording critical details like:  
  - Officer's name  
  - Artifact ID and description  
  - Timestamp  
  - Status (Checked In or Checked Out)  
  - SHA256-based hash for integrity  

### 3. **Comprehensive Logging**  
- Logs every interaction with the artifact, creating a transparent and auditable history.  

### 4. **Role-Specific Functionality**  
#### **Admin**:  
- Creates and assigns artifacts while managing their blockchain instances.  
#### **Police Officers**:  
- Logs in to:  
  - Check out artifacts for investigation or court hearings.  
  - Check in artifacts after use, ensuring proper custody.  

### 5. **Enhanced Security**  
- Eliminates tampering by requiring all interactions to be logged as blockchain entries.  
- Officers' identities and actions are tied to every block.  

---

## 🔍 How It Works  

### **Scenario Flow**  

#### **Artifact Creation (Admin):**  
1. Admin logs into the system.  
2. Adds new artifacts to the database.  
3. Each artifact is assigned a dedicated blockchain instance running on a unique port.  

#### **Artifact Handling (Police Officer):**  
1. Officer logs in and selects an artifact to check out.  
2. A new block is created, capturing:  
   - Officer's name  
   - Check-out time  
   - Artifact details  
3. The officer returns the artifact after use, creating another block to record the check-in.  

#### **Immutable History:**  
- All actions are logged on the blockchain, ensuring tamper-proof records that can be audited anytime.  

---

# 🚀 Getting Started

## Prerequisites

1. **Install Go**.
2. **Install the required Go packages**:
   ```bash
   go get github.com/davecgh/go-spew
   go get github.com/gorilla/mux
   go get github.com/joho/godotenv
   ```

---

## Setup

1. **Clone this repository**:
   ```bash
   git clone https://github.com/yourusername/blockchain-coc.git
   cd blockchain-coc
   ```

2. **Create a `.env` file** with the port number for your artifact's blockchain:
   ```plaintext
   PORT=3001
   ```

3. **Run the blockchain server**:
   ```bash
   go run main.go
   ```

---

## Run Multiple Instances

For each artifact, create a separate `.env` file with a unique port, and run the blockchain code in a new terminal instance:
   ```bash
   PORT=3002 go run main.go
   PORT=3003 go run main.go
   # And so on...
   ```

---

# 🌐 API Endpoints

| Method | Endpoint | Description |
|--------|----------|-------------|
| GET    | /        | Retrieve the current blockchain. |
| POST   | /        | Add a new block to the blockchain. |

---

### Example Payload for POST /:
```json
{
  "ProductId": "ART123",
  "ProductModel": "Fingerprint Sample",
  "User": "Officer Jane Doe",
  "Status": "Checked Out"
}
```

### Example Response:
```json
{
  "Index": 2,
  "ProductId": "ART123",
  "ProductModel": "Fingerprint Sample",
  "User": "Officer Jane Doe",
  "Status": "Checked Out",
  "Timestamp": "2024-12-06T10:00:00Z",
  "PrevHash": "abc123...",
  "Hash": "def456..."
}
```

---

# 💻 Demo

## Admin Workflow:
1. Admin creates an artifact and assigns it a port.
2. The blockchain server for the artifact is launched.
3. Officers can interact with the blockchain via API.

## Police Officer Workflow:
1. Officer logs in and selects an artifact to check out.
2. A POST request logs the transaction.
3. After the artifact is returned, another POST logs the check-in.

---

# 🎨 Why Blockchain?

- **Tamper-Proof**: Blocks are immutable and cryptographically secure.
- **Transparent**: Every action is logged and visible for auditing.
- **Secure**: Officer details are tied to every transaction, ensuring accountability.

---

# 🛠️ Built With

- **Go Language**: High performance and simplicity.
- **Gorilla Mux**: Lightweight router for HTTP handlers.
- **SHA256 Hashing**: Cryptographic hashing for data integrity.

---

# 🤝 Contributions

We welcome your contributions! Fork this repo and submit a pull request to improve B-COC.
