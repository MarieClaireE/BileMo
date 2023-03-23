# ClientApi

All URIs are relative to *http://api.bilemo.com/api*

Method | HTTP request | Description
------------- | ------------- | -------------
[**clientsClientIdDelete**](ClientApi.md#clientsClientIdDelete) | **DELETE** /clients/{clientId} | Delete customer by Id.
[**clientsClientIdGet**](ClientApi.md#clientsClientIdGet) | **GET** /clients/{clientId} | Returns a customer by Id.
[**clientsGet**](ClientApi.md#clientsGet) | **GET** /clients | Returns a list of customers.


<a name="clientsClientIdDelete"></a>
# **clientsClientIdDelete**
> clientsClientIdDelete(clientId)

Delete customer by Id.

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ClientApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ClientApi apiInstance = new ClientApi(defaultClient);
    Long clientId = 4L; // Long | 
    try {
      apiInstance.clientsClientIdDelete(clientId);
    } catch (ApiException e) {
      System.err.println("Exception when calling ClientApi#clientsClientIdDelete");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **clientId** | **Long**|  |

### Return type

null (empty response body)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: Not defined

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | Customer deleted. |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |
**404** | ClientId not found. |  -  |

<a name="clientsClientIdGet"></a>
# **clientsClientIdGet**
> Client clientsClientIdGet(clientId)

Returns a customer by Id.

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ClientApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ClientApi apiInstance = new ClientApi(defaultClient);
    Long clientId = 4L; // Long | 
    try {
      Client result = apiInstance.clientsClientIdGet(clientId);
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling ClientApi#clientsClientIdGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **clientId** | **Long**|  |

### Return type

[**Client**](Client.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | OK. |  -  |
**400** | Customer with the specified ID was not found. |  -  |
**401** | Expired JWT Token |  -  |

<a name="clientsGet"></a>
# **clientsGet**
> List&lt;Client&gt; clientsGet()

Returns a list of customers.

### Example
```java
// Import classes:
import org.openapitools.client.ApiClient;
import org.openapitools.client.ApiException;
import org.openapitools.client.Configuration;
import org.openapitools.client.auth.*;
import org.openapitools.client.models.*;
import org.openapitools.client.api.ClientApi;

public class Example {
  public static void main(String[] args) {
    ApiClient defaultClient = Configuration.getDefaultApiClient();
    defaultClient.setBasePath("http://api.bilemo.com/api");
    
    // Configure HTTP bearer authorization: JWT
    HttpBearerAuth JWT = (HttpBearerAuth) defaultClient.getAuthentication("JWT");
    JWT.setBearerToken("BEARER TOKEN");

    ClientApi apiInstance = new ClientApi(defaultClient);
    try {
      List<Client> result = apiInstance.clientsGet();
      System.out.println(result);
    } catch (ApiException e) {
      System.err.println("Exception when calling ClientApi#clientsGet");
      System.err.println("Status code: " + e.getCode());
      System.err.println("Reason: " + e.getResponseBody());
      System.err.println("Response headers: " + e.getResponseHeaders());
      e.printStackTrace();
    }
  }
}
```

### Parameters
This endpoint does not need any parameter.

### Return type

[**List&lt;Client&gt;**](Client.md)

### Authorization

[JWT](../README.md#JWT)

### HTTP request headers

 - **Content-Type**: Not defined
 - **Accept**: application/json

### HTTP response details
| Status code | Description | Response headers |
|-------------|-------------|------------------|
**200** | A JSON array returning id, email and role of customers. |  -  |
**401** | Le token d&#39;accès est invalide ou manquant |  -  |

